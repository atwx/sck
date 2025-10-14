<?php

namespace Atwx\Sck\Tags;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\SearchableMultiDropdownField;

class TaggableDataObject extends DataObject
{
    private static $db = [
    ];

    private static $many_many = [
        'Tags' => Tag::class,
    ];

    private static $field_labels = [
        'Tags' => 'Tags',
    ];

    /**
     * CMS Fields
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Tags');
        $fields->addFieldToTab('Root.Main', SearchableMultiDropdownField::create(
            'Tags',
            _t(self::class . '.Tags', self::$field_labels['Tags']),
            Tag::get(),
            $this->Tags()->map('ID', 'ID')->toArray()
        ));
        return $fields;
    }

    private static $table_name = 'SCK_TaggableDataObject';
}
