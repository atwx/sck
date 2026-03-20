<?php

namespace Atwx\Sck\News;

use Page;
use SilverStripe\Forms\DropdownField;

class NewsPage extends Page
{

    private static $db = [
        "BackgroundColor" => "Varchar(32)",
    ];

    private static $table_name = 'NewsPage';
    private static $singular_name = 'News Seite';
    private static $plural_name = 'News Seiten';
    private static $cms_icon_class = 'font-icon-news';
    private static $class_description = 'Seite für News Einträge';

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