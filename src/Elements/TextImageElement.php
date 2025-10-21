<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use DNADesign\Elemental\Models\BaseElement;

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
        "Highlight" => "Varchar(20)",
        "ImgWidth" => "Varchar(20)",
        "BackgroundColor" => "Varchar(32)",
    ];

    private static $has_one = [
        "Image" => Image::class,
        "Button" => Link::class,
    ];

    private static $owns = [
        "Image",
        "Button",
    ];

    private static $field_labels = [
        "Text" => "Text",
        "Image" => "Bild",
        "Button" => "Button",
    ];

    private static $table_name = 'SCK_TextImageElement';
    private static $icon = 'font-icon-block-promo-3';

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
        $fields->replaceField('Variant', new DropdownField('Variant', 'Variante', [
            "" => "Bild rechts",
            "image--right" => "Bild links",
        ]));
        $fields->replaceField('ImgWidth', new DropdownField('ImgWidth', 'Bildbreite', [
            "image--30" => "30%",
            "image--40" => "40%",
            "image--50" => "50%",
            "image--60" => "60%",
            "image--70" => "70%",
        ]));
        $fields->replaceField('Highlight', new DropdownField('Highlight', 'Highlight', [
            "" => "Kein Highlight",
            "highlighted" => "Highlight",
        ]));
        $fields->addFieldToTab('Root.Main',
            DropdownField::create('BackgroundColor', 'Hintergrundfarbe', [
                '' => 'Keine',
                'bgc-primary' => 'Primärfarbe',
                'bgc-secondary' => 'Sekundärfarbe'
            ])
            ->setDescription('Bestimmt die Hintergrundfarbe des Elements')
        );

        $fields->removeByName('ButtonID');
        $fields->addFieldToTab('Root.Main', LinkField::create('Button'));
        return $fields;
    }
}
