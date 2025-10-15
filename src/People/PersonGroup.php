<?php

namespace Atwx\Sck\People;

use Override;
use Atwx\Sck\People\Person;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentExtension;

class PersonGroup extends DataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
    ];

    private static $belongs_many_many = [
        'People' => Person::class,
    ];

    private static $default_sort = 'Title ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'People' => 'Personen',
    ];

    private static $table_name = 'SCK_PersonGroup';
    private static $singular_name = 'Personengruppe';
    private static $plural_name = 'Personengruppen';

    private static $summary_fields = [
        'Title' => 'Titel',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }
}
