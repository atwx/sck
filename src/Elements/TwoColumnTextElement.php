<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Class \Atwx\Sck\Elements\TwoColumnTextElement
 *
 * @property string $LeftTitle
 * @property string $RightText
 * @property string $Layout
 * @property string $TitleVerticalPosition
 */
class TwoColumnTextElement extends BaseElement
{
    private static $db = [
        'LeftTitle' => 'Varchar(255)',
        'RightText' => 'HTMLText',
        'Layout' => "Enum('title-left,title-right', 'title-left')",
        'TitleVerticalPosition' => "Enum('top,center,bottom', 'center')",
    ];

    private static $field_labels = [
        'LeftTitle' => 'Titel',
        'RightText' => 'Text',
        'Layout' => 'Layout',
        'TitleVerticalPosition' => 'Titel vertikale Position',
    ];

    private static $table_name = 'SCK_TwoColumnTextElement';
    private static $icon = 'font-icon-block-content';
    private static $singular_name = 'Zwei-Spalten Text Element';
    private static $plural_name = 'Zwei-Spalten Text Elemente';

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('LeftTitle', 'Titel')
                ->setDescription('Der große Titel'),

            HTMLEditorField::create('RightText', 'Text')
                ->setDescription('Der Beschreibungstext für die Text Spalte')
                ->setRows(5),

            DropdownField::create('Layout', 'Layout', [
                'title-left' => 'Titel links, Text rechts',
                'title-right' => 'Titel rechts, Text links'
            ])
                ->setDescription('Bestimmt die Position von Titel und Text'),

            DropdownField::create('TitleVerticalPosition', 'Titel vertikale Position', [
                'top' => 'Oben',
                'center' => 'Mittig',
                'bottom' => 'Unten'
            ])
                ->setDescription('Bestimmt die vertikale Ausrichtung des Titels')
        ]);

        return $fields;
    }

    #[Override]
    public function getType()
    {
        return 'Zwei-Spalten Text';
    }

    #[Override]
    public function getTitle()
    {
        return $this->LeftTitle ?: 'Zwei-Spalten Text Element';
    }

    #[Override]
    public function getSummary()
    {
        $summary = [];

        if ($this->LeftTitle) {
            $summary[] = "Titel: " . $this->LeftTitle;
        }

        if ($this->RightText) {
            $plainText = strip_tags($this->RightText);
            $textPreview = strlen($plainText) > 50 ? substr($plainText, 0, 50) . "..." : $plainText;
            $summary[] = "Text: " . $textPreview;
        }

        $layoutLabel = $this->Layout === 'title-right' ? 'Titel rechts' : 'Titel links';
        $summary[] = "Layout: " . $layoutLabel;

        $positionLabels = [
            'top' => 'Oben',
            'center' => 'Mittig',
            'bottom' => 'Unten'
        ];
        $positionLabel = $positionLabels[$this->TitleVerticalPosition] ?? 'Mittig';
        $summary[] = "Position: " . $positionLabel;

        return implode(" | ", $summary) ?: "Zwei-Spalten Text Element";
    }
}
