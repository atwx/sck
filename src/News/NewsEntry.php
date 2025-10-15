<?php

namespace Atwx\Sck\News;

use Override;
use SilverStripe\Assets\Image;
use Atwx\Sck\Tags\TaggableDataObject;
use SilverStripe\LinkField\Models\Link;
use TractorCow\Fluent\Extension\FluentExtension;

class NewsEntry extends TaggableDataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Date' => 'Date',
        'Content' => 'HTMLText',
        'ShowInNewsElement' => 'Boolean',
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

    private static $default_sort = 'Date ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'Date' => 'Datum',
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

        return $fields;
    }

    #[Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
    }

    #[Override]
    public function getTitle()
    {
        // Verwende das Standard-Field-Accessor Pattern
        $title = $this->getField('Title');
        if (!empty($title)) {
            return $title;
        }

        // Fallback zu News Eintrag mit ID
        return 'News Eintrag' . ($this->ID ? ' #' . $this->ID : '');
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
}
