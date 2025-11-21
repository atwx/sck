<?php
namespace App\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Forms\TextCheckboxGroupField;

class ElementExtension extends Extension
{
    private static $db = [
        "BackgroundColor" => "Varchar(32)",
        "FadeInAnimation" => "Varchar(255)",
    ];

    private static $defaults = [
        "BackgroundColor" => "section-background--default",
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Style',
            DropdownField::create('BackgroundColor', 'Hintergrundfarbe', [
                '' => 'Keine',
                'bgc-primary' => 'Primärfarbe',
                'bgc-secondary' => 'Sekundärfarbe'
            ])
            ->setDescription('Bestimmt die Hintergrundfarbe des Elements')
        );

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
