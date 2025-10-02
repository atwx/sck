<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\LinkField\Models\Link;

/**
 * Class \Atwx\Sck\Elements\ShowcaseElement
 *
 * @property string $Content
 * @property string $ContentPosition
 * @property int $ImageID
 * @property int $ButtonID
 * @method Image Image()
 * @method Link Button()
 */
class ShowcaseElement extends BaseElement
{
    private static $db = [
        "Content" => "HTMLText",
        "ContentPosition" => "Enum('top-left,top-center,top-right,center-left,center-center,center-right,bottom-left,bottom-center,bottom-right','center-left')",
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
        "Title" => "Überschrift",
        "Content" => "Text",
        "ContentPosition" => "Position des Textkastens",
        "Image" => "Hintergrundbild",
        "Button" => "Button",
    ];

    private static $table_name = 'SCK_ShowcaseElement';
    private static $icon = 'font-icon-block-promo-2';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Showcase";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Überschrift: " . $this->Title;
        }

        if ($this->Content) {
            $plainText = strip_tags($this->Content);
            $textPreview = strlen($plainText) > 50 ? substr($plainText, 0, 50) . "..." : $plainText;
            $summary[] = "Text: " . $textPreview;
        }

        if ($this->Image && $this->Image->exists()) {
            $summary[] = "Bild: " . $this->Image->Name;
        }

        if ($this->Button && $this->Button->exists()) {
            $summary[] = "Button: " . $this->Button->Title;
        }

        if ($this->ContentPosition) {
            $positions = $this->getContentPositionOptions();
            $summary[] = "Position: " . $positions[$this->ContentPosition];
        }

        return implode(" | ", $summary) ?: "Showcase Element";
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ButtonID');
        $fields->removeByName('ContentPosition');

        $contentPositionField = DropdownField::create(
            'ContentPosition',
            'Position des Textkastens',
            $this->getContentPositionOptions()
        );
        $contentPositionField->setDescription('1 = Vertikal, 2 = Horizontal');

        $fields->addFieldToTab('Root.Main', $contentPositionField);

        $fields->addFieldToTab('Root.Main', LinkField::create('Button', 'Button'));

        return $fields;
    }

    /**
     * Get options for content position dropdown
     * @return array
     */
    private function getContentPositionOptions()
    {
        return [
            'top-left' => 'Oben Links',
            'top-center' => 'Oben Mitte',
            'top-right' => 'Oben Rechts',
            'center-left' => 'Mitte Links',
            'center-center' => 'Mitte Mitte',
            'center-right' => 'Mitte Rechts',
            'bottom-left' => 'Unten Links',
            'bottom-center' => 'Unten Mitte',
            'bottom-right' => 'Unten Rechts',
        ];
    }

    /**
     * Get CSS classes for content position
     * @return string
     */
    public function getContentPositionClass()
    {
        return 'showcase-content--' . $this->ContentPosition;
    }
}
