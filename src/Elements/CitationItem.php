<?php

namespace Atwx\Sck\Elements;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentExtension;

class CitationItem extends DataObject
{
    private static $db = [
        'Author' => 'Varchar(255)',
        'Quote' => 'HTMLText',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        "Image" => Image::class,
        'Parent' => CitationElement::class,
    ];
    

    private static $owns = [
        "Image",
    ];

    private static $field_labels = [
        'Author' => 'Autor',
        'Quote' => 'Zitat Text',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Bild',
        'Author' => 'Autor',
        'Quote.Summary' => 'Zitat Text',
    ];

    
    private static $extensions = [
        FluentExtension::class,
    ];

    private static $default_sort = 'SortOrder DESC';
    private static $table_name = 'SCK_CitationItem';
    private static $singular_name = 'Zitat';
    private static $plural_name = 'Zitate';

    protected function onBeforeWrite()
    {
        if (!$this->SortOrder) {
            $this->SortOrder = CitationItem::get()->max('SortOrder') + 1;
        }

        parent::onBeforeWrite();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('SortOrder');
        $fields->removeByName('ParentID');
        
        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

}