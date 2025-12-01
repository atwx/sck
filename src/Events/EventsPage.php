<?php

namespace Atwx\Sck\Events;

use Page;
use SilverStripe\Forms\DropdownField;

class EventsPage extends Page
{
    private static $db = [
        "BackgroundColor" => "Varchar(32)",
        "Intro" => "HTMLText",
    ];

    private static $many_many = [
    ];

    private static $table_name = 'EventsPage';
    private static $singular_name = 'Termine Seite';
    private static $plural_name = 'Termine Seiten';
    private static $cms_icon_class = 'font-icon-menu-modaladmin';
    private static $class_description = 'Seite für Termine';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            DropdownField::create('BackgroundColor', 'Hintergrundfarbe', [
                '' => 'Keine',
                'bgc-primary' => 'Primärfarbe',
                'bgc-secondary' => 'Sekundärfarbe'
            ])
        ]);

        return $fields;
    }
}
