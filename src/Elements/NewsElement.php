<?php

namespace Atwx\Sck\Elements;

use Atwx\Sck\News\NewsEntry;
use Override;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Class \Atwx\Sck\Elements\NewsElement
 *
 * @property string $Subtitle
 * @property string $Description
 * @property int $MainButtonID
 * @method Link MainButton()
 */
class NewsElement extends BaseElement
{
    private static $db = [
        "Subtitle" => "Varchar(255)",
        "Description" => "HTMLText",
        "NumberOfItems" => "Int",
    ];

    private static $defaults = [
        "NumberOfItems" => 3,
    ];

    private static $has_one = [
        'MainButton' => Link::class,
        'PrefixIcon' => File::class
    ];

    private static $owns = [
        'MainButton',
        'PrefixIcon',
    ];

    private static $field_labels = [
        "Title" => "Haupttitel",
        "Subtitle" => "Untertitel",
        "Description" => "Beschreibung",
        "MainButton" => "Haupt-Button",
        "NumberOfItems" => "Anzahl der News-Einträge",
    ];

    private static $table_name = 'SCK_NewsElement';
    private static $icon = 'font-icon-news';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Aktuelles";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        if ($this->Subtitle) {
            $summary[] = "Untertitel: " . $this->Subtitle;
        }

        $newsCount = $this->getNewsItems()->count();
        $summary[] = $newsCount . " News Eintrag" . ($newsCount !== 1 ? "e" : "");

        return implode(" | ", $summary) ?: "Aktuelles Element";
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = ($this->Subtitle ?: $this->Title) ?: "Aktuelles";
        return $blockSchema;

    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Subtitle', 'Untertitel')
                ->setDescription('Ein optionaler Untertitel'),
            HTMLEditorField::create('Description', 'Beschreibung')
                ->setRows(3)
                ->setDescription('Eine optionale Beschreibung, die unter dem Titel angezeigt wird'),
            LinkField::create('MainButton', 'Haupt-Button')
                ->setDescription('Der "Mehr darüber" Button')
        ]);

        $fields->addFieldsToTab('Root.Style', [
            UploadField::create("PrefixIcon", "Icon-Prefix")
                ->setDescription('Ein optionales Icon, das vor dem Titel angezeigt wird'),
            TextField::create('NumberOfItems', 'Anzahl der News-Einträge')
                ->setDescription('Die Anzahl der anzuzeigenden News-Einträge')
        ]);

        return $fields;
    }

    #[Override]
    public function canCreate($member = null, $context = [])
    {
        return parent::canCreate($member, $context);
    }

    public function getNewsItems()
    {
        $limit = $this->NumberOfItems ?: 3;
        return NewsEntry::get()
            ->filter('ShowInNewsElement', true)
            ->sort('Date DESC')
            ->limit($limit);
    }
}
