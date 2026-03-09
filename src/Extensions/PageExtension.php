<?php

namespace Atwx\Sck\Extensions;

use Atwx\Sck\Elements\HeroSlide;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\Forms\GridField\GridField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\LiteralField;
use DNADesign\Elemental\Models\ElementalArea;

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
        "SwipeSpeed" => "Int",
        "UseH1ForTitle" => "Boolean",
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
        'HeroHeightUnit' => 'vh',
        'HeroAutoPlayDelay' => 10000,
        'SwipeSpeed' => 800,
    ];

    public function updateCMSFields(FieldList $fields)
    {
        
        $h1Check = $this->checkForH1();
        if ($h1Check) {
            $fields->addFieldToTab("Root.Main", new LiteralField(
                'H1CheckNotice',
                '<div class="alert alert-warning" role="alert">' . $h1Check . '</div>'
            ), "NavStripVersion");
        }

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
            NumericField::create('HeroAutoPlayDelay', 'Abspielgeschwindigkeit (ms)')
                ->setDescription('Zeit in Millisekunden zwischen den Folien (z.B. 5000 = 5 Sekunden)')
                ->setValue($this->owner->HeroAutoPlayDelay ?: 10000),
            NumericField::create('SwipeSpeed', 'Wischgeschwindigkeit (ms)')
                ->setDescription('Geschwindigkeit des Folienwechsels beim Wischen (z.B. 800 = 0,8 Sekunden)')
                ->setValue(800),
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

    public function checkForH1()
    {
        $h1Count = 0;

        // H1 aus dem Hero-Bereich (Seiten-Einstellung)
        if ($this->owner->UseH1ForTitle) {
            $h1Count++;
        }

        // h1-Tags in HTMLText-Feldern der HeroSlides
        foreach ($this->owner->HeroSlides() as $slide) {
            $h1Count += $this->countH1InHTMLFields($slide);
        }

        // H1 aus Elementen (UseH1ForTitle + h1-Tags in HTMLText-Feldern)
        $h1Count += $this->countH1InElementalArea();

        if ($h1Count > 1) {
            return "ACHTUNG: Diese Seite hat " . $h1Count . " H1-Überschriften. Es sollte genau eine H1 pro Seite vorhanden sein. Dies kann einen negativen Effekt auf SEO und Barrierefreiheit haben.";
        } elseif ($h1Count === 0) {
            return "ACHTUNG: Diese Seite verwendet keine H1-Überschrift. Es sollte genau eine H1 pro Seite vorhanden sein. Dies kann einen negativen Effekt auf SEO und Barrierefreiheit haben.";
        }

        return null;
    }

    private function countH1InElementalArea(): int
    {
        $count = 0;

        if (!$this->owner->hasMethod('ElementalArea') || !$this->owner->ElementalArea()) {
            return 0;
        }

        foreach ($this->owner->ElementalArea()->Elements() as $element) {
            // UseH1ForTitle rendert den Element-Titel als h1
            if ($element->UseH1ForTitle) {
                $count++;
            }

            // h1-Tags in HTMLText-Feldern des Elements selbst
            $count += $this->countH1InHTMLFields($element);

            // h1-Tags in HTMLText-Feldern von Child-Items (has_many)
            $hasManyRelations = $element->config()->get('has_many');
            if ($hasManyRelations) {
                foreach (array_keys($hasManyRelations) as $relationName) {
                    try {
                        $items = $element->$relationName();
                        if ($items && $items->exists()) {
                            foreach ($items as $item) {
                                $count += $this->countH1InHTMLFields($item);
                            }
                        }
                    } catch (\Exception) {
                        // Relation überspringen falls nicht verfügbar
                    }
                }
            }
        }

        return $count;
    }

    private function countH1InHTMLFields($record): int
    {
        $count = 0;
        $dbFields = $record->config()->get('db');

        if (!$dbFields) {
            return 0;
        }

        foreach ($dbFields as $fieldName => $fieldType) {
            if (strpos($fieldType, 'HTMLText') !== false || strpos($fieldType, 'HTMLFragment') !== false) {
                $content = $record->$fieldName;
                if ($content) {
                    preg_match_all('/<h1[\s\/>]/i', $content, $matches);
                    $count += count($matches[0]);
                }
            }
        }

        return $count;
    }
}
