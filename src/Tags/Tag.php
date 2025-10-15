<?php

namespace Atwx\Sck\Tags;

use Override;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentExtension;

class Tag extends DataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
    ];

    private static $belongs_many_many = [
        'Objects' => TaggableDataObject::class,
    ];

    private static $default_sort = 'Title ASC';

    private static $field_labels = [
        'Title' => 'Titel',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $table_name = 'SCK_Tag';
    private static $singular_name = 'Tag';
    private static $plural_name = 'Tags';

    private static $summary_fields = [
        'Title' => 'Titel',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields;
    }

    #[Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
    }

    #[Override]
    public function getTitle()
    {
        // Verwende das Standard-Field-Accessor Pattern
        $title = $this->getField('Title');
        if (!empty($title)) {
            return $title;
        }

        // Fallback zu News Eintrag mit ID
        return 'Tag' . ($this->ID ? ' #' . $this->ID : '');
    }

    /**
     * Overrides the default Title property for GridField display
     */
    #[Override]
    public function summaryFields()
    {
        return [
            'Title' => 'Titel',
        ];
    }
}
