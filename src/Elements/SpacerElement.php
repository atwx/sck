<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use DNADesign\Elemental\Models\BaseElement;

/**
 * Class \Atwx\Sck\Elements\SpacerElement
 *
 * @property int $Height
 * @property string $HeightUnit
 * @property string $BackgroundColor
 * @property string $ColorMode
 */
class SpacerElement extends BaseElement
{
    private static $db = [
        'Height' => 'Int',
        'HeightUnit' => "Enum('px,vh,vw,em,rem','px')",
        'BackgroundColor' => 'Varchar(7)',
        'ColorMode' => 'Varchar(50)',
    ];

    private static $field_labels = [
        'Height' => 'Höhe',
        'HeightUnit' => 'Höhen-Einheit',
        'BackgroundColor' => 'Hintergrundfarbe',
        'ColorMode' => 'Farbmodus',
    ];

    private static $defaults = [
        'Height' => 50,
        'HeightUnit' => 'px',
        'BackgroundColor' => '#ffffff',
        'ColorMode' => 'custom',
    ];

    private static $table_name = 'SpacerElement';
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

        if ($this->ColorMode === 'primary') {
            $summary[] = "Farbe: Primary";
        } elseif ($this->ColorMode === 'secondary') {
            $summary[] = "Farbe: Secondary";
        } elseif ($this->ColorMode === 'transparent') {
            $summary[] = "Farbe: Transparent";
        } elseif ($this->BackgroundColor && $this->ColorMode === 'custom') {
            $summary[] = "Farbe: " . $this->BackgroundColor;
        }

        return $summary === [] ? 'Abstandselement' : implode(', ', $summary);
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $colorModeField = DropdownField::create('ColorMode', $this->fieldLabel('ColorMode'), [
            'custom' => 'Benutzerdefinierte Farbe',
            'primary' => 'Primary Color',
            'secondary' => 'Secondary Color',
            'transparent' => 'Transparent'
        ])->setDescription('Wählen Sie den Farbmodus für den Hintergrund');

        $backgroundColorField = TextField::create('BackgroundColor', $this->fieldLabel('BackgroundColor'))
            ->setAttribute('type', 'color')
            ->setDescription('Wählen Sie eine benutzerdefinierte Hintergrundfarbe');

        $backgroundColorField->addExtraClass('spacer-background-color-field');

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

            $colorModeField,
            $backgroundColorField,
        ]);

        $fields->addFieldToTab('Root.Main',
            LiteralField::create('SpacerElementJS', '
                <script>
                (function() {
                    function toggleColorField() {
                        var colorMode = document.querySelector(\'select[name="ColorMode"]\');
                        var colorField = document.querySelector(\'.spacer-background-color-field\').closest(\'.field\');

                        if (colorMode && colorField) {
                            if (colorMode.value === "custom") {
                                colorField.style.display = "block";
                            } else {
                                colorField.style.display = "none";
                            }
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        toggleColorField();
                        var colorModeSelect = document.querySelector(\'select[name="ColorMode"]\');
                        if (colorModeSelect) {
                            colorModeSelect.addEventListener("change", toggleColorField);
                        }
                    });
                })();
                </script>
            ')
        );

        return $fields;
    }

    public function getComputedBackgroundColor()
    {
        return match ($this->ColorMode) {
            'primary' => 'var(--color-primary)',
            'secondary' => 'var(--color-secondary)',
            'transparent' => 'transparent',
            default => $this->BackgroundColor ?: '#ffffff',
        };
    }

    public function getInlineStyles()
    {
        $styles = [];

        if ($this->Height) {
            $styles[] = 'height: ' . $this->Height . $this->HeightUnit;
        }

        $backgroundColor = $this->getComputedBackgroundColor();
        if ($backgroundColor) {
            $styles[] = 'background-color: ' . $backgroundColor;
        }

        return implode('; ', $styles);
    }

    public function getHeightStyle()
    {
        if ($this->Height && $this->HeightUnit) {
            return "height: {$this->Height}{$this->HeightUnit};";
        }
        return "height: 50px;";
    }
}
