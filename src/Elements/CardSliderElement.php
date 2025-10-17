<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\LiteralField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class CardSliderElement extends BaseElement
{
    private static $db = [
        'SliderTitle' => 'Varchar(255)',
        'ShowDots' => 'Boolean',
        'ShowArrows' => 'Boolean',
        'Autoplay' => 'Boolean',
        'AutoplaySpeed' => 'Int',
    ];

    private static $has_many = [
        'Cards' => CardSlide::class,
    ];

    private static $owns = [
        'Cards',
    ];

    private static $cascade_deletes = [
        'Cards',
    ];

    private static $cascade_duplicate = [
        'Cards',
    ];

    private static $defaults = [
        'SliderTitle' => 'Karten',
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
        'Cards' => 'Kacheln',
    ];

    private static $table_name = 'SCK_CardSliderElement';
    private static $icon = 'font-icon-block-carousel';
    private static $singular_name = 'Karten Slider';
    private static $plural_name = 'Karten Slider';
    private static $inline_editable = false;

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Title', 'Cards']);

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
                'Cards',
                'Karten',
                $this->Cards(),
                $slidesConfig
            );
            $slidesField->getConfig()->addComponent(GridFieldOrderableRows::create('SortOrder'));

            $fields->addFieldToTab('Root.Main', $slidesField);
        } else {
            $fields->addFieldToTab(
                'Root.Main',
                LiteralField::create(
                    'CardSlidesNote',
                    '<p class="message notice">Speichern Sie das Element zuerst, um Karten hinzuzufügen.</p>'
                )
            );
        }

        return $fields;
    }

    #[Override]
    public function getType()
    {
        return 'Karten Slider';
    }

    #[Override]
    public function getTitle()
    {
        return $this->SliderTitle ?: 'Karten Slider';
    }

    #[Override]
    public function getSummary()
    {
        $summary = [];

        if ($this->SliderTitle) {
            $summary[] = "Titel: " . $this->SliderTitle;
        }

        $slideCount = $this->Cards()->count();
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

        return implode(" | ", $summary) ?: "Karten Slider";
    }
}
