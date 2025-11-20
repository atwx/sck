<?php

namespace Atwx\Sck\Elements;

use Atwx\Sck\Tags\TaggableDataObject;
use SilverStripe\ORM\DataObject;

class CitationItem extends DataObject
{
    private static $db = [
        'Author' => 'Varchar(255)',
        'Quote' => 'HTMLText',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'Parent' => CitationElement::class,
    ];

    private static $field_labels = [
        'Author' => 'Autor',
        'Quote' => 'Zitat Text',
    ];

    private static $summary_fields = [
        'Author' => 'Autor',
        'Quote.Summary' => 'Zitat Text',
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

        return $fields;
    }

}