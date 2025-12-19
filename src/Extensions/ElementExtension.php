<?php
namespace App\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use SilverStripe\Forms\CheckboxField;

class ElementExtension extends Extension
{
    private static $db = [
        "BackgroundColor" => "Varchar(32)",
        "FadeInAnimation" => "Varchar(255)",
        "ElementDecoration" => "Varchar(32)",
    ];

    private static $field_labels = [
        "BackgroundColor" => "Hintergrundfarbe",
        "FadeInAnimation" => "Fade-In Animation",
        "ElementDecoration" => "Element-Dekoration",
    ];

    private static $defaults = [
        "BackgroundColor" => "section-background--default",
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Style', [
            DropdownField::create('BackgroundColor', 'Hintergrundfarbe', [
                '' => 'Keine',
                'bgc-primary' => 'Primärfarbe',
                'bgc-primary-dark' => 'Dunkle Primärfarbe',
                'bgc-primary-light' => 'Helle Primärfarbe',
                'bgc-secondary' => 'Sekundärfarbe',
                'bgc-secondary-dark' => 'Dunkle Sekundärfarbe',
                'bgc-secondary-light' => 'Helle Sekundärfarbe',
            ])
            ->setDescription('Bestimmt die Hintergrundfarbe des Elements'),
            DropdownField::create('FadeInAnimation', 'Eingangs Animation', [
                '' => 'Keine',
                'fadein' => 'Einblenden',
                'flyinleft' => 'Einblenden von links',
                'flyinright' => 'Einblenden von rechts',
                'flyinleftbig' => 'Einblenden von links groß',
                'flyinrightbig' => 'Einblenden von rechts groß',
                'flyin' => 'Hineinfliegen',
                'flyinbig' => 'Hineinfliegen groß',
                'bouncein' => 'Hineinspringen',
                'bounceinleft' => 'Hineinspringen von links',
                'bounceinright' => 'Hineinspringen von rechts',
                'backinleft' => 'Hineinziehen von links',
                'backinright' => 'Hineinziehen von rechts',
            ])->setDescription('Wählen Sie eine Animation aus, die angewendet wird, wenn das Element in den Viewport scrollt.'),
            DropdownField::create('ElementDecoration', 'Element-Dekoration', [
                '' => 'Keine',
                'elementdecoration--small' => 'Icon',
                'elementdecoration--large' => 'großes Icon',
                'elementdecoration--smallwhite' => 'Icon weiß',
                'elementdecoration--largewhite' => 'großes Icon weiß',
            ])->setDescription('Fügt dem Element eine dekorative Grafik hinzu.')
            ]);

        //Move Custom CSS Classes field to Style tab
        $customCSSField = $fields->dataFieldByName('ExtraClass');
        if ($customCSSField) {
            $fields->removeByName('ExtraClass');
            $fields->addFieldToTab('Root.Style', $customCSSField);
        }
        //Remove Settings Tab if empty
        if ($fields->fieldByName('Root.Settings') && !$fields->fieldByName('Root.Settings')->Fields()->count()) {
            $fields->removeByName('Settings');
        }
    }
}
