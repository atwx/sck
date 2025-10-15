<?php

namespace App\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentVersionedExtension;

/**
 * Class \App\Extensions\BaseElementFluentExtension
 *
 * @property BaseElement|\App\Extensions\BaseElementFluentExtension $owner
 */
class BaseElementFluentExtension extends FluentVersionedExtension
{
    public function updateCMSFields(FieldList $fields): void
    {
        parent::updateCMSFields($fields);
        $fields->removeByName("RecordLocales");
    }

    public function printLocalisedFields()
    {
        $fields = $this->getOwner()->getLocalisedFields();

        $class = get_class($this->getOwner());
        $fields = DataObject::getSchema()->databaseFields($class, false);
        print_r($fields);
        die();
    }
}
