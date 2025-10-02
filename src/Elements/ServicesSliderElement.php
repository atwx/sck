<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataList;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\LiteralField;

/**
 * Class \Atwx\Sck\Elements\ServicesSliderElement
 *
 * @property string $SliderTitle
 * @property bool $ShowDots
 * @property bool $ShowArrows
 * @property bool $Autoplay
 * @property int $AutoplaySpeed
 * @method DataList|ServiceSlide[] ServiceSlides()
 */
class ServicesSliderElement extends BaseElement
{
    private static $db = [
        'SliderTitle' => 'Varchar(255)',
        'ShowDots' => 'Boolean',
        'ShowArrows' => 'Boolean',
        'Autoplay' => 'Boolean',
        'AutoplaySpeed' => 'Int',
    ];

    private static $has_many = [
        'ServiceSlides' => ServiceSlide::class,
    ];

    private static $owns = [
        'ServiceSlides',
    ];

    private static $cascade_deletes = [
        'ServiceSlides',
    ];

    private static $cascade_duplicate = [
        'ServiceSlides',
    ];

    private static $defaults = [
        'SliderTitle' => 'Services',
        'ShowDots' => true,
        'ShowArrows' => true,
        'Autoplay' => false,
        'AutoplaySpeed' => 5000,
    ];

    private static $field_labels = [
        'SliderTitle' => 'Slider Titel',
        'ShowDots' => 'Punkte anzeigen',
        'ShowArrows' => 'Pfeile anzeigen',
        'Autoplay' => 'Automatisches Abspielen',
        'AutoplaySpeed' => 'Abspielgeschwindigkeit (ms)',
        'ServiceSlides' => 'Service Kacheln',
    ];

    private static $table_name = 'SCK_ServicesSliderElement';
    private static $icon = 'font-icon-block-carousel';
    private static $singular_name = 'Services Slider';
    private static $plural_name = 'Services Slider';
    private static $inline_editable = false;

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('SliderTitle', 'Slider Titel')
                ->setDescription('Der Haupttitel über dem Slider'),

            CheckboxField::create('ShowDots', 'Punkte anzeigen')
                ->setDescription('Zeigt Navigationspunkte unter dem Slider'),

            CheckboxField::create('ShowArrows', 'Pfeile anzeigen')
                ->setDescription('Zeigt Vor/Zurück-Pfeile am Slider'),

            CheckboxField::create('Autoplay', 'Automatisches Abspielen')
                ->setDescription('Slider wechselt automatisch zur nächsten Folie'),

            NumericField::create('AutoplaySpeed', 'Abspielgeschwindigkeit (ms)')
                ->setDescription('Zeit in Millisekunden zwischen den Folien (z.B. 5000 = 5 Sekunden)')
                ->setValue(5000),
        ]);

        if ($this->exists()) {
            $slidesConfig = GridFieldConfig_RecordEditor::create();

            $slidesField = GridField::create(
                'ServiceSlides',
                'Service Kacheln',
                $this->ServiceSlides(),
                $slidesConfig
            );

            $fields->addFieldToTab('Root.Main', $slidesField);
        } else {
            $fields->addFieldToTab('Root.Main',
                LiteralField::create(
                    'ServiceSlidesNote',
                    '<p class="message notice">Speichern Sie das Element zuerst, um Service-Kacheln hinzuzufügen.</p>'
                )
            );
        }

        return $fields;
    }

    #[Override]
    public function getType()
    {
        return 'Services Slider';
    }

    #[Override]
    public function getTitle()
    {
        return $this->SliderTitle ?: 'Services Slider';
    }

    #[Override]
    public function getSummary()
    {
        $summary = [];

        if ($this->SliderTitle) {
            $summary[] = "Titel: " . $this->SliderTitle;
        }

        $slideCount = $this->ServiceSlides()->count();
        $summary[] = $slideCount . " Slide" . ($slideCount !== 1 ? "s" : "");

        $settings = [];
        if ($this->ShowDots) {
            $settings[] = "Punkte";
        }
        if ($this->ShowArrows) {
            $settings[] = "Pfeile";
        }
        if ($this->Autoplay) {
            $settings[] = "Autoplay (" . $this->AutoplaySpeed . "ms)";
        }

        if ($settings !== []) {
            $summary[] = "Einstellungen: " . implode(", ", $settings);
        }

        return implode(" | ", $summary) ?: "Services Slider";
    }
}
