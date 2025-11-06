<?php

namespace Atwx\Sck\Extensions;

use Atwx\Sck\Elements\HeroSlide;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\Forms\GridField\GridField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class PageExtension extends Extension
{
    private static $db = [
        "MenuPosition" => "Enum('main,footer', 'main')",
        "ShowHeroSection" => "Boolean",
        "HeaderNavPosition" => "Enum('above,below', 'above')",
        "NavStripVersion" => "Enum('default,alternative', 'default')",
        "HeroHeight" => "Int",
        "HeroHeightUnit" => "Enum('px,vh,vw','vh')",
        "HeroAutoPlay" => "Boolean",
        "HeroAutoPlayDelay" => "Int",
    ];

    private static $has_many = [
        "HeroSlides" => HeroSlide::class,
    ];

    private static $owns = [
        "HeroSlides",
    ];

    private static $defaults = [
        'ShowHeroSection' => true,
        'HeroHeight' => 60,
        'HeroHeightUnit' => 'vh'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Main", new DropdownField("MenuPosition", "Menü", [
            "main" => "Hauptmenü",
            "footer" => "Footer",
        ]), "Content");

        $headerNavPositionField = DropdownField::create('HeaderNavPosition', 'Navigation Position', [
            'above' => 'Über dem Hero-Bereich',
            'below' => 'Unter dem Hero-Bereich'
        ]);
        $headerNavPositionField->setDescription('Wählen Sie aus, ob die Navigation über oder unter dem Hero-Bereich angezeigt werden soll.');

        $fields->addFieldToTab("Root.Main", $headerNavPositionField, "Content");

        $navStripVersionField = DropdownField::create('NavStripVersion', 'Navigation Design', [
            'default' => 'Standard Design',
            'alternative' => 'Alternatives Design'
        ]);
        $navStripVersionField->setDescription('Wählen Sie das Design der Navigation aus. Das alternative Design verwendet ein anderes Logo und andere Farben.');

        $fields->addFieldToTab("Root.Main", $navStripVersionField, "Content");

        $fields->removeByName("HeroSlides");
        $fields->addFieldsToTab("Root.Hero", [
            CheckboxField::create('ShowHeroSection', 'Hero-Bereich anzeigen')
                ->setDescription('Aktivieren Sie diese Option, um den Hero-Bereich auf dieser Seite anzuzeigen'),
            GridField::create(
                'HeroSlides',
                'Hero Slides',
                $this->owner->HeroSlides(),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(new GridFieldOrderableRows('SortOrder'))
            ),
            $headerNavPositionField,
            NumericField::create('HeroHeight', 'Hero Höhe')
                ->setDescription('Die Höhe des Hero-Bereichs')
                ->setValue($this->owner->HeroHeight ?: 60),
            DropdownField::create('HeroHeightUnit', 'Hero Höhen-Einheit', [
                'vh' => 'Viewport Height (vh) - Prozent der Bildschirmhöhe',
                'px' => 'Pixel (px) - Feste Pixelangabe',
                'vw' => 'Viewport Width (vw) - Prozent der Bildschirmbreite'
            ])->setDescription('Die Einheit für die Höhenangabe des Hero-Bereichs'),
            CheckboxField::create('HeroAutoPlay', 'Automatisches Abspielen der Hero-Slides')
                ->setDescription('Aktivieren Sie diese Option, damit die Hero-Slides automatisch wechseln'),
            NumericField::create('HeroAutoPlayDelay', 'Verzögerung für automatisches Abspielen (in ms)')
                ->setDescription('Die Verzögerung in Millisekunden zwischen den automatischen Slide-Wechseln')
                ->setValue($this->owner->HeroAutoPlayDelay ?: 10000),
        ]);
    }

    /*
    * LocaleMenu
    *
    * Returns the locale menu for the current subsite
    */
    public function LocaleMenu() {
        $subsite = $this->CurrentSubsite();
        if (!$subsite) {
            return null;
        }
        $availableLocales =  $subsite->getActiveLocales();
        $menu = new ArrayList();
        foreach ($availableLocales as $locale) {
            $recordLocale = ExtensibleRecordLocale::create($this->data(), $locale, $this->SubURLSegment);
            $menu->push($recordLocale);
        }
        return $menu;
    }

    public function getHeroHeightStyle()
    {
        if ($this->owner->HeroHeight) {
            return "height: {$this->owner->HeroHeight}{$this->owner->HeroHeightUnit};";
        }
        return "height: 60vh;";
    }
}
