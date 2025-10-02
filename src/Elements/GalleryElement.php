<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataList;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;

/**
 * Class \Atwx\Sck\Elements\GalleryElement
 *
 * @property string $Text
 * @property bool $ActivateLightbox
 * @property string $ImageSize
 * @property string $ImageFormat
 * @property string $BackgroundColor
 * @method DataList|\PurpleSpider\BasicGalleryExtension\PhotoGalleryImage[] PhotoGalleryImages()
 * @mixin \PurpleSpider\BasicGalleryExtension\PhotoGalleryExtension
 */
class GalleryElement extends BaseElement
{

    private static $db = [
        "Text" => "HTMLText",
        "ActivateLightbox" => "Boolean",
        "ImageSize" => "Enum('extrasmall, small, medium, large', 'medium')",
        "ImageFormat" => "Enum('square, rectangle, original', 'square')",
        "BackgroundColor" => "Enum('transparent, primary, secondary, black, white', 'transparent')",
    ];

    private static $has_one = [];

    private static $has_many = [];

    private static $owns = [];

    private static $field_labels = [
        "Text" => "Text",
        "Lightbox" => "Lightbox aktivieren",
        "ImageSize" => "Bildgröße",
    ];

    private static $table_name = 'SCK_GalleryElement';
    private static $icon = 'font-icon-picture';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Galerie";
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

        $imageCount = $this->PhotoGalleryImages()->count();
        $summary[] = $imageCount . " Bild" . ($imageCount !== 1 ? "er" : "");

        $sizeLabels = [
            'extrasmall' => 'Extra Klein',
            'small' => 'Klein',
            'medium' => 'Mittel',
            'large' => 'Groß'
        ];
        $size = $sizeLabels[$this->ImageSize] ?? 'Mittel';
        $summary[] = "Größe: " . $size;

        $formatLabels = [
            'square' => 'Quadratisch',
            'rectangle' => 'Rechteckig',
            'original' => 'Original'
        ];
        $format = $formatLabels[$this->ImageFormat] ?? 'Quadratisch';
        $summary[] = "Format: " . $format;

        if ($this->ActivateLightbox) {
            $summary[] = "Lightbox aktiviert";
        }

        return implode(" | ", $summary) ?: "Galerie Element";
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
        $fields->addFieldToTab('Root.Anpassung', new DropdownField('ImageSize', 'Bildgröße', [
            'extrasmall' => 'Extra Klein',
            'small' => 'Klein',
            'medium' => 'Mittel',
            'large' => 'Groß'
        ]));
        $fields->addFieldToTab('Root.Anpassung', new DropdownField('ImageFormat', 'Bildformat', [
            'square' => 'Quadratisch',
            'rectangle' => 'Rechteckig',
            'original' => 'Original'
        ]));
        $fields->addFieldToTab('Root.Anpassung', new DropdownField('ActivateLightbox', 'Lightbox aktivieren', [
            '0' => 'Nein',
            '1' => 'Ja'
        ]));
        $fields->addFieldToTab('Root.Anpassung', new DropdownField('BackgroundColor', 'Hintergrundfarbe', [
            'transparent' => 'Transparent',
            'primary' => 'Primär',
            'secondary' => 'Sekundär',
            'black' => 'Schwarz',
            'white' => 'Weiß'
        ]));
        return $fields;
    }
}
