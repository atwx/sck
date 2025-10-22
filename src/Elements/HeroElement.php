<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use DNADesign\Elemental\Models\BaseElement;

/**
 * Class Atwx\Sck\Elements\HeroElement
 *
 * @property string $Content
 * @property float $DarknessOverlay
 * @property int $ImageID
 * @property int $ButtonID
 * @method Image Image()
 * @method Link Button()
 */
class HeroElement extends BaseElement
{
    private static $db = [
        "Content" => "HTMLText",
        "DarknessOverlay" => "Float(4)",
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
        "Title" => "Titel",
    ];

    private static $table_name = 'SCK_HeroElement';
    private static $icon = 'font-icon-block-promo-3';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Hero";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        if ($this->Content) {
            $plainText = strip_tags($this->Content);
            $textPreview = strlen($plainText) > 50 ? substr($plainText, 0, 50) . "..." : $plainText;
            $summary[] = "Inhalt: " . $textPreview;
        }

        if ($this->Image && $this->Image->exists()) {
            $summary[] = "Bild: " . $this->Image->Name;
        }

        if ($this->Button && $this->Button->exists()) {
            $summary[] = "Button: " . $this->Button->Title;
        }

        if ($this->DarknessOverlay > 0) {
            $summary[] = "Dunkelheit: " . $this->DarknessOverlay;
        }

        return implode(" | ", $summary) ?: "Hero Element";
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ButtonID');
        $fields->addFieldToTab('Root.Main', LinkField::create('Button'));

        return $fields;
    }
}
