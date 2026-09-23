<?php

namespace Atwx\Sck\News;

use Override;
use SilverStripe\Assets\Image;
use Atwx\Sck\Tags\TaggableDataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\ORM\Queries\SQLUpdate;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\View\Parsers\URLSegmentFilter;
use TractorCow\Fluent\Model\Locale;
use TractorCow\Fluent\State\FluentState;

class NewsEntry extends TaggableDataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'URLSegment' => 'Varchar(255)',
        'Date' => 'Date',
        'ShortContent' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'ShowInNewsElement' => 'Boolean',
    ];

    private static $defaults = [
        'ShowInNewsElement' => true,
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Category' => NewsCategory::class,
    ];

    private static $has_many = [
        'Links' => Link::class,
    ];

    private static $owns = [
        'Image',
        'Links',
    ];

    private static $cascade_deletes = [
        'Image',
        'Links',
    ];

    private static $cascade_duplicate = [
        'Image',
        'Links',
    ];

    private static $indexes = [
        'URLSegment' => true,
    ];

    private static $default_sort = 'Date ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'URLSegment' => 'URL-Segment',
        'Date' => 'Datum',
        'ShortContent' => 'Kurztext',
        'Content' => 'Inhalt',
        'Image' => 'Bild',
        'Links' => 'Links',
        'Category' => 'Kategorie',
        'Tags' => 'Tags',
        'ShowInNewsElement' => 'In News-Elementen anzeigen',
    ];

    private static $table_name = 'SCK_NewsEntry';
    private static $singular_name = 'News Eintrag';
    private static $plural_name = 'News Einträge';

    private static $summary_fields = [
        'Thumbnail' => 'Bild',
        'Title' => 'Titel',
        'FormattedDate' => 'Datum',
        'Content.Summary' => 'Inhalt',
        'ShowInNewsElement' => 'In News-Elementen anzeigen',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->replaceField(
            'URLSegment',
            TextField::create('URLSegment', $this->fieldLabel('URLSegment'))
                ->setDescription('Wird beim Speichern automatisch aus dem Titel erzeugt, wenn das Feld leer ist. Kann danach angepasst werden.')
        );
        $fields->insertAfter('Title', $fields->dataFieldByName('URLSegment'));

        return $fields;
    }

    #[Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        // Like pages: generated from the title when empty, otherwise the edited
        // value is only normalised and made unique.
        $source = trim((string) $this->URLSegment) !== '' ? $this->URLSegment : $this->Title;
        $this->URLSegment = $this->generateUniqueURLSegment((string) $source);
    }

    /**
     * Gives entries created before URL segments existed a segment, in every
     * locale they are localised in.
     *
     * The values are written with plain SQL: a Fluent write() in another locale
     * would also copy that locale's title and content into the base table.
     */
    #[Override]
    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        $baseTable = DataObject::getSchema()->tableName(static::class);

        $this->fillMissingURLSegments(null, $baseTable);

        if (!class_exists(Locale::class)) {
            return;
        }
        foreach (Locale::get()->column('Locale') as $locale) {
            FluentState::singleton()->withState(function (FluentState $state) use ($locale, $baseTable) {
                $state->setLocale($locale);
                $this->fillMissingURLSegments($locale, $baseTable . '_Localised');
            });
        }
    }

    protected function fillMissingURLSegments(?string $locale, string $table): void
    {
        $idColumn = $locale ? 'RecordID' : 'ID';
        $select = SQLSelect::create('"' . $idColumn . '"', '"' . $table . '"')
            ->addWhere('("URLSegment" IS NULL OR "URLSegment" = \'\')');
        if ($locale) {
            $select->addWhere(['"Locale" = ?' => $locale]);
        }

        foreach ($select->execute()->column($idColumn) as $id) {
            // Loaded in the current locale, so the localised title is used.
            $entry = static::get()->byID($id);
            if (!$entry) {
                continue;
            }

            $update = SQLUpdate::create('"' . $table . '"')
                ->assign('"URLSegment"', $entry->generateUniqueURLSegment((string) $entry->Title))
                ->addWhere(['"' . $idColumn . '" = ?' => $id]);
            if ($locale) {
                $update->addWhere(['"Locale" = ?' => $locale]);
            }
            $update->execute();
        }
    }

    /**
     * Turns a string into a URL segment that no other entry in the current
     * locale uses.
     */
    public function generateUniqueURLSegment(string $source): string
    {
        $segment = URLSegmentFilter::create()->filter($source);
        if ($segment === '' || $segment === '-') {
            $segment = 'news';
        }

        // Purely numeric segments would be taken for an ID by the controller.
        if (ctype_digit($segment)) {
            $segment = 'news-' . $segment;
        }

        $candidate = $segment;
        $count = 2;
        while ($this->urlSegmentExists($candidate)) {
            $candidate = $segment . '-' . $count++;
        }

        return $candidate;
    }

    protected function urlSegmentExists(string $segment): bool
    {
        $list = static::get()->filter('URLSegment', $segment);
        if ($this->ID) {
            $list = $list->exclude('ID', $this->ID);
        }
        return $list->exists();
    }

    /**
     * Overrides the default Title property for GridField display
     */
    #[Override]
    public function summaryFields()
    {
        return [
            'Thumbnail' => 'Bild',
            'Title' => 'Titel',
            'FormattedDate' => 'Datum',
            'Content.Summary' => 'Inhalt',
        ];
    }

    public function getThumbnail()
    {
        if ($this->Image()->exists()) {
            return $this->Image()->CMSThumbnail();
        }
        return null;
    }

    public function getFormattedDate()
    {
        if ($this->Date) {
            return date('d.m.Y', strtotime($this->Date));
        }
        return null;
    }

    public function Link()
    {
        $page = NewsPage::get()->first();
        if ($page) {
            return $page->Link('view/' . ($this->URLSegment ?: $this->ID));
        }
        return null;
    }
}
