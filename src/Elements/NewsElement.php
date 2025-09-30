<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataList;
use App\Elements\NewsItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

/**
 * Class \Atwx\Sck\Elements\NewsElement
 *
 * @property string $Subtitle
 * @property string $Description
 * @property int $MainButtonID
 * @method Link MainButton()
 * @method DataList|NewsItem[] NewsItems()
 */
class NewsElement extends BaseElement
{
    private static $db = [
        "Subtitle" => "Varchar(255)",
        "Description" => "HTMLText",
    ];

    private static $has_one = [
        'MainButton' => Link::class,
    ];

    private static $has_many = [
        "NewsItems" => NewsItem::class,
    ];

    private static $owns = [
        'MainButton',
    ];

    private static $field_labels = [
        "Title" => "Haupttitel",
        "Subtitle" => "Untertitel",
        "Description" => "Beschreibung",
        "MainButton" => "Haupt-Button",
        "NewsItems" => "News Einträge",
    ];

    private static $table_name = 'NewsElement';
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

        $newsCount = $this->NewsItems()->count();
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

        $fields->removeByName(['MainButtonID']);

        // Grundeinstellungen
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Subtitle', 'Untertitel')
                ->setDescription('Ein optionaler Untertitel für das Aktuelles-Element'),
            HTMLEditorField::create('Description', 'Beschreibung')
                ->setRows(3)
                ->setDescription('Eine optionale Beschreibung, die unter dem Titel angezeigt wird'),
            LinkField::create('MainButton', 'Haupt-Button')
                ->setDescription('Der "Mehr darüber" Button')
        ]);

        // News Einträge GridField
        if ($this->ID) {
            $newsConfig = GridFieldConfig_RelationEditor::create();
            $newsField = GridField::create(
                'NewsItems',
                'News Einträge',
                $this->NewsItems(),
                $newsConfig
            );

            $fields->addFieldToTab('Root.NewsItems', $newsField);
        } else {
            $fields->addFieldToTab('Root.NewsItems',
                LiteralField::create(
                    'FirstSave',
                    '<p>Speichern Sie dieses Element zuerst, um News Einträge hinzufügen zu können.</p>'
                )
            );
        }

        return $fields;
    }

    #[Override]
    public function canCreate($member = null, $context = [])
    {
        return parent::canCreate($member, $context);
    }
}
