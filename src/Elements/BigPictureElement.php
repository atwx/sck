<?php

namespace Atwx\Sck\Elements;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;

/**
 * Class Atwx\Sck\Elements\BigPictureElement
 *
 * @property int $Height
 * @property string $HeightUnit
 * @property int $ImageID
 * @method Image Image()
 */
class BigPictureElement extends BaseElement
{
    private static $db = [
        "Height" => "Int",
        "HeightUnit" => "Enum('px,vh,vw','vh')",
    ];

    private static $has_one = [
        "Image" => Image::class,
    ];

    private static $owns = [
        "Image",
    ];

    private static $defaults = [
        "Height" => 60,
        "HeightUnit" => "vh",
    ];

    private static $field_labels = [
        "Title" => "Titel",
        "Image" => "Hintergrundbild",
        "Height" => "Höhe",
        "HeightUnit" => "Höhen-Einheit",
    ];

    private static $table_name = 'SCK_BigPictureElement';
    private static $icon = 'font-icon-block-banner';
    private static $inline_editable = false;

    public function getType()
    {
        return "Big Picture";
    }

    public function getSummary(): string
    {
        $summary = [];
        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }
        if ($this->Image()->exists()) {
            $summary[] = "Bild: " . $this->Image()->Name;
        }
        if ($this->Height) {
            $summary[] = "Höhe: " . $this->Height . $this->HeightUnit;
        }
        return implode(" | ", $summary) ?: "Big Picture Element";
    }

    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->Title ?: "Big Picture";
        return $blockSchema;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main',
            UploadField::create('Image', 'Hintergrundbild')
                ->setFolderName('big-picture-images')
                ->setAllowedFileCategories('image')
                ->setDescription('Das Bild für das Big Picture Element')
        );

        $fields->addFieldsToTab('Root.Style', [
            NumericField::create('Height', 'Höhe')
                ->setDescription('Die Höhe des Big Picture Elements')
                ->setValue($this->Height ?: 60),
            DropdownField::create('HeightUnit', 'Höhen-Einheit', [
                'vh' => 'Viewport Height (vh) - Prozent der Bildschirmhöhe',
                'px' => 'Pixel (px) - Feste Pixelangabe',
                'vw' => 'Viewport Width (vw) - Prozent der Bildschirmbreite'
            ])->setDescription('Die Einheit für die Höhenangabe')
        ]);

        return $fields;
    }
    public function getHeightStyle()
    {
        if ($this->Height) {
            return "height: {$this->Height}{$this->HeightUnit};";
        }
        return "height: 60vh;";
    }
}
