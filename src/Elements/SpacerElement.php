<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use DNADesign\Elemental\Models\BaseElement;

class SpacerElement extends BaseElement
{
    private static $db = [
        'Height' => 'Int',
        'HeightUnit' => "Enum('px,vh,vw,em,rem','px')",
    ];

    private static $field_labels = [
        'Height' => 'Höhe',
        'HeightUnit' => 'Höhen-Einheit',
    ];

    private static $defaults = [
        'Height' => 50,
        'HeightUnit' => 'px',
    ];

    private static $table_name = 'SCK_SpacerElement';
    private static $icon = 'font-icon-resize';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Abstand";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Height) {
            $summary[] = "Höhe: " . $this->Height . $this->HeightUnit;
        }

        return $summary === [] ? 'Abstandselement' : implode(', ', $summary);
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            NumericField::create('Height', $this->fieldLabel('Height'))
                ->setDescription('Die Höhe des Abstands')
                ->setAttribute('min', '1')
                ->setAttribute('max', '500')
                ->setValue($this->Height ?: 50),

            DropdownField::create('HeightUnit', $this->fieldLabel('HeightUnit'), [
                'px' => 'Pixel (px) - Feste Pixelangabe',
                'vh' => 'Viewport Height (vh) - Prozent der Bildschirmhöhe',
                'vw' => 'Viewport Width (vw) - Prozent der Bildschirmbreite',
                'em' => 'Em (em) - Relativ zur Schriftgröße',
                'rem' => 'Rem (rem) - Relativ zur Root-Schriftgröße'
            ])->setDescription('Die Einheit für die Höhenangabe'),
        ]);

        return $fields;
    }

    public function getHeightStyle()
    {
        if ($this->Height && $this->HeightUnit) {
            return "height: {$this->Height}{$this->HeightUnit};";
        }
        return "height: 50px;";
    }
}
