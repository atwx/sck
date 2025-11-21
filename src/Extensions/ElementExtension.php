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
        "ShowDecoration" => "Boolean",
    ];

    private static $field_labels = [
        "BackgroundColor" => "Hintergrundfarbe",
        "FadeInAnimation" => "Fade-In Animation",
        "ShowDecoration" => "Dekoration anzeigen",
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
                'bgc-secondary' => 'Sekundärfarbe'
            ])
            ->setDescription('Bestimmt die Hintergrundfarbe des Elements'),
            DropdownField::create('FadeInAnimation', 'Fade-In Animation', [
                '' => 'Keine',
                'fadein' => 'Einblenden',
                'flyin' => 'Hineinfliegen',
            ])->setDescription('Wählen Sie eine Animation aus, die angewendet wird, wenn das Element in den Viewport scrollt.'),
            CheckboxField::create('ShowDecoration', 'Dekoration anzeigen')
                ->setDescription('Fügt dem Element eine dekorative Grafik hinzu.')
            ]);

        $fields->replaceField(
            'Title',
            TextCheckboxGroupField::create()
                ->setName('Title')
        );

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
