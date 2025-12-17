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

class HTMLElement extends BaseElement
{
    private static $db = [
        "HTMLContent" => "Text",
    ];

    private static $defaults = [
    ];

    private static $field_labels = [
        "Title" => "Haupttitel",
        "HTMLContent" => "HTML-Inhalt",
    ];

    private static $table_name = 'SCK_HTMLElement';
    private static $icon = 'font-icon-html';
    private static $inline_editable = true;

    #[Override]
    public function getType()
    {
        return "HTML-Element";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        return implode(" | ", $summary) ?: "HTML-Element";
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = ($this->Title) ?: "HTML-Element";
        return $blockSchema;
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }

    #[Override]
    public function canCreate($member = null, $context = [])
    {
        return parent::canCreate($member, $context);
    }
}
