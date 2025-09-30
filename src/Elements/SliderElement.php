<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;

/**
 * Class \Atwx\Sck\Elements\SliderElement
 *
 * @property bool $ShowArrows
 * @property string $ArrowsPosition
 * @property bool $Autoplay
 * @property int $AutoplayDelay
 * @property string $TransitionEffect
 * @property float $OverlayOpacity
 * @property string $WidthLevel
 * @property string $TitleColor
 * @method DataList|\PurpleSpider\BasicGalleryExtension\PhotoGalleryImage[] PhotoGalleryImages()
 * @mixin \PurpleSpider\BasicGalleryExtension\PhotoGalleryExtension
 */
class SliderElement extends BaseElement
{
    private static $table_name = 'SliderElement';
    private static $icon = 'font-icon-picture';
    private static $inline_editable = false;

    private static $owns = [
        'PhotoGalleryImages',
    ];

    private static $db = [
        'ShowArrows' => 'Boolean',
        'ArrowsPosition' => "Enum('bottom,center,top', 'center')",
        'Autoplay' => 'Boolean',
        'AutoplayDelay' => 'Int',
        'TransitionEffect' => "Enum('slide,fade', 'slide')",
        'OverlayOpacity' => 'Decimal(3,2)',
        'WidthLevel' => "Enum('narrow,medium,wide', 'medium')",
        'TitleColor' => 'Varchar(7)',
    ];

    private static $field_labels = [
        'ShowArrows' => 'Pfeile anzeigen',
        'ArrowsPosition' => 'Position der Pfeile',
        'Autoplay' => 'Automatischer Wechsel',
        'AutoplayDelay' => 'Autoplay-Verzögerung (ms)',
        'TransitionEffect' => 'Übergangseffekt',
        'OverlayOpacity' => 'Bild-Verdunklung',
        'WidthLevel' => 'Slider-Breite',
        'TitleColor' => 'Farbe',
    ];

    private static $defaults = [
        'ShowArrows' => true,
        'ArrowsPosition' => 'center',
        'Autoplay' => true,
        'AutoplayDelay' => 5000,
        'OverlayOpacity' => 0.4,
        'WidthLevel' => 'medium',
        'TitleColor' => '#000000',
    ];

    #[Override]
    public function getType()
    {
        return 'Slider';
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        $imageCount = $this->PhotoGalleryImages()->count();
        $summary[] = $imageCount . " Slide" . ($imageCount !== 1 ? "s" : "");

        $settings = [];
        if ($this->ShowArrows) {
            $arrowPos = ['bottom' => 'unten', 'top' => 'oben', 'center' => 'zentriert'];
            $settings[] = "Pfeile " . ($arrowPos[$this->ArrowsPosition] ?? 'zentriert');
        }
        if ($this->Autoplay) {
            $settings[] = "Autoplay (" . $this->AutoplayDelay . "ms)";
        }
        $settings[] = "Effekt: " . ucfirst($this->TransitionEffect);

        if ($settings !== []) {
            $summary[] = implode(", ", $settings);
        }

        return implode(" | ", $summary) ?: "Slider Element";
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Slides']);

        $fields->addFieldsToTab('Root.Main', [
            CheckboxField::create('ShowArrows', self::$field_labels['ShowArrows']),
            DropdownField::create('ArrowsPosition', self::$field_labels['ArrowsPosition'], [
                'bottom' => 'Unten',
                'top' => 'Oben',
                'center' => 'Zentriert',
            ]),
            DropdownField::create('TransitionEffect', self::$field_labels['TransitionEffect'], [
                'slide' => 'Slide',
                'fade' => 'Fade',
            ]),
            DropdownField::create('WidthLevel', self::$field_labels['WidthLevel'], [
                'narrow' => 'Content Width',
                'medium' => 'Max Width',
                'wide' => 'Full Width',
            ]),
            CheckboxField::create('Autoplay', self::$field_labels['Autoplay']),
            NumericField::create('AutoplayDelay', self::$field_labels['AutoplayDelay']),
            TextField::create('OverlayOpacity', self::$field_labels['OverlayOpacity'])
                ->setDescription('Wert zwischen 0 (keine Verdunklung) und 1 (komplett schwarz) Bsp. 0.2')
                ->setAttribute('step', '0,01')
                ->setAttribute('min', '0')
                ->setAttribute('max', '1'),
            TextField::create('TitleColor', self::$field_labels['TitleColor'])
                ->setAttribute('type', 'color')
                ->setDescription('Farbe für den Titel und die Navigationspfeile auswählen'),
        ]);
        return $fields;
    }
}
