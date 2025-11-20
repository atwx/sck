<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataList;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * Class \Atwx\Sck\Elements\CitationElement
 *
 * @property string $Text
 * @property bool $ActivateLightbox
 * @property string $ImageSize
 * @property string $ImageFormat
 * @property string $BackgroundColor
 * @method DataList|\PurpleSpider\BasicGalleryExtension\PhotoGalleryImage[] PhotoGalleryImages()
 * @mixin \PurpleSpider\BasicGalleryExtension\PhotoGalleryExtension
 */
class CitationElement extends BaseElement
{

    private static $db = [
        "Text" => "HTMLText",
    ];

    private static $has_one = [];

    private static $has_many = [
        'CitationItems' => CitationItem::class,
    ];

    private static $owns = [
        'CitationItems',
    ];

    private static $field_labels = [
        "Text" => "Text",
        "CitationItems" => "Zitate",
    ];

    private static $table_name = 'SCK_CitationElement';
    private static $icon = 'font-icon-block-quote';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Zitat";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        if ($this->Text) {
            $plainText = strip_tags($this->Text);
            $textPreview = strlen($plainText) > 40 ? substr($plainText, 0, 40) . "..." : $plainText;
            $summary[] = "Text: " . $textPreview;
        }

        return implode(" | ", $summary) ?: "Zitat Element";
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->Text ? $this->dbObject('Text')->Plain() : "Kein Text";
        return $blockSchema;
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('CitationItems');
        $fields->addFieldsToTab('Root.Main', [
            GridField::create(
                'CitationItems',
                'Zitate',
                $this->CitationItems(),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(GridFieldOrderableRows::create('SortOrder'))
            )
        ]);
        return $fields;
    }
}
