<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class PageExtension extends Extension
{
    private static $db = [
        "MenuPosition" => "Enum('main,footer', 'main')",
        "ShowHeroSection" => "Boolean",
        "HeroTitle" => "Varchar(255)",
        "HeroTopline" => "Varchar(255)",
        "HeroTopline2" => "Varchar(255)",
        "HeaderNavPosition" => "Enum('above,below', 'above')",
        "NavStripVersion" => "Enum('default,alternative', 'default')",
        "HeroHeight" => "Int",
        "HeroHeightUnit" => "Enum('px,vh,vw','vh')",
    ];

    private static $has_one = [
        "HeroImage" => Image::class,
    ];

    private static $owns = [
        'HeroImage',
    ];

    private static $cascade_deletes = [
        'HeroImage',
    ];

    private static $cascade_duplicate = [
        'HeroImage',
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

        $fields->addFieldToTab(
            "Root.Main",
            CheckboxField::create('ShowHeroSection', 'Hero-Bereich anzeigen')
                ->setDescription('Aktivieren Sie diese Option, um den Hero-Bereich auf dieser Seite anzuzeigen'),
            "Content"
        );

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

        $heroImageField = UploadField::create('HeroImage', 'Hero Hintergrundbild');
        $heroImageField->setFolderName('Uploads/hero-images');
        $heroImageField->setAllowedExtensions(['jpg', 'jpeg', 'png', 'webp']);
        $heroImageField->setAllowedMaxFileNumber(1);
        $heroImageField->setIsMultiUpload(false);
        $heroImageField->setDescription('Empfohlene Größe: 1920x800px für optimale Darstellung');

        $heroImageField->getValidator()->setAllowedExtensions(['jpg', 'jpeg', 'png', 'webp']);

        $fields->addFieldsToTab("Root.Hero", [
            $heroImageField,
            TextField::create('HeroTitle', 'Hero Titel')
                ->setDescription('Haupttitel im Hero-Bereich (z.B. "Cuxhaven Business")'),
            TextField::create('HeroTopline', 'Hero Topline')
                ->setDescription('Obertitel im Hero-Bereich (z.B. "Maritime Stadt mit Zukunft")'),
            TextField::create('HeroTopline2', 'Hero 2. Topline')
            ->setDescription('2. Obertitel im Hero-Bereich'),
            NumericField::create('HeroHeight', 'Hero Höhe')
                ->setDescription('Die Höhe des Hero-Bereichs')
                ->setValue($this->owner->HeroHeight ?: 60),
            DropdownField::create('HeroHeightUnit', 'Hero Höhen-Einheit', [
                'vh' => 'Viewport Height (vh) - Prozent der Bildschirmhöhe',
                'px' => 'Pixel (px) - Feste Pixelangabe',
                'vw' => 'Viewport Width (vw) - Prozent der Bildschirmbreite'
            ])->setDescription('Die Einheit für die Höhenangabe des Hero-Bereichs')
        ]);
    }

    public function getHeroHeightStyle()
    {
        if ($this->owner->HeroHeight) {
            return "height: {$this->owner->HeroHeight}{$this->owner->HeroHeightUnit};";
        }
        return "height: 60vh;";
    }
}
