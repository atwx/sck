<?php

namespace Atwx\Sck\News;

use Override;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentExtension;

class NewsCategory extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $has_one = [
        'Parent' => NewsCategory::class,
    ];

    private static $has_many = [
        'Children' => NewsCategory::class,
    ];

    private static $belongs_many = [
        'NewsEntries' => NewsEntry::class,
    ];

    private static $default_sort = 'Title ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'Parent' => 'Übergeordnete Kategorie',
        'Children' => 'Unterkategorien',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $table_name = 'SCK_NewsCategory';
    private static $singular_name = 'Kategorie';
    private static $plural_name = 'Kategorien';

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

        // Fallback zu News Kategorie mit ID
        return 'News Kategorie' . ($this->ID ? ' #' . $this->ID : '');
    }

    /**
     * Overrides the default Title property for GridField display
     */
    #[Override]
    public function summaryFields()
    {
        return [
            'Title' => 'Titel'
        ];
    }
}
