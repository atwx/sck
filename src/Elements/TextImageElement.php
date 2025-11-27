<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\LinkField\Form\MultiLinkField;

/**
 * Class \Atwx\Sck\Elements\TextImageElement
 *
 * @property string $Text
 * @property string $Variant
 * @property int $ImageID
 * @property int $ButtonID
 * @method Image Image()
 * @method Link Button()
 */
class TextImageElement extends BaseElement
{

    private static $db = [
        "Text" => "HTMLText",
        "Variant" => "Varchar(20)",
        "ColumnRatio" => "Varchar(30)",
        "LinksTitle" => "Varchar(255)",
        "VideoLink" => "Varchar(255)",
    ];

    private static $has_one = [
        "Image" => Image::class,
        "Button" => Link::class,
    ];

    private static $has_many = [
        "SideLinks" => Link::class,
    ];

    private static $owns = [
        "Image",
        "Button",
        "SideLinks",
    ];

    private static $field_labels = [
        "Text" => "Text",
        "Image" => "Bild",
        "Button" => "Button",
        "Variant" => "Bildausrichtung",
        "ColumnRatio" => "Spaltenverhältnis",
        "LinksTitle" => "Titel der Linkliste",
        "VideoLink" => "Video-Link (Youtube)",
    ];

    private static $defaults = [
        "Variant" => "image--right",
        "ColumnRatio" => "columnratio--1-1",
    ];

    private static $table_name = 'SCK_TextImageElement';
    private static $icon = 'font-icon-block-promo-3';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Text+Bild";
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

        if ($this->Image && $this->Image->exists()) {
            $summary[] = "Bild: " . $this->Image->Name;
        }

        $variant = $this->Variant === 'image--right' ? 'Bild rechts' : 'Bild links';
        $summary[] = "Layout: " . $variant;

        if ($this->Button && $this->Button->exists()) {
            $summary[] = "Button: " . $this->Button->Title;
        }

        return implode(" | ", $summary) ?: "Element mit Text und Bild";
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

        $fields->addFieldsToTab('Root.Style', [
            DropdownField::create('ColumnRatio', 'Spaltenverhältnis', [
                "columnratio--3-7" => "3:7",
                "columnratio--4-6" => "4:6",
                "columnratio--1-1" => "1:1",
                "columnratio--6-4" => "6:4",
                "columnratio--7-3" => "7:3",
            ]),
            DropdownField::create('Variant', 'Bildausrichtung', [
                "image--right" => "Bild rechts",
                "image--left" => "Bild links",
                "image--wideright" => "Breites Bild rechts",
                "image--wideleft" => "Breites Bild links",
            ]),
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('LinksTitle', 'Titel der Linkliste')
                ->setDescription('Titel, der über der Linkliste angezeigt wird'),
            MultiLinkField::create('SideLinks')
                ->setTitle('SideLinks')
                ->setDescription('Fügt Links / Downloads neben dem Text hinzu'),
            LinkField::create('Button')
        ]);
        
        return $fields;
    }
}
