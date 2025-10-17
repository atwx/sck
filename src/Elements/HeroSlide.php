<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\AssetAdmin\Forms\UploadField;
use TractorCow\Fluent\Extension\FluentExtension;

class HeroSlide extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'SubTitle' => 'Varchar(255)',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        "Parent" => SiteTree::class,
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $cascade_deletes = [
        'Image',
    ];

    private static $cascade_duplicate = [
        'Image',
    ];

    private static $default_sort = 'SortOrder ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'SubTitle' => 'Untertitel',
        'Image' => 'Bild',
        'SortOrder' => 'Reihenfolge',
    ];

    private static $table_name = 'SCK_HeroSlide';
    private static $singular_name = 'Hero-Bild';
    private static $plural_name = 'Hero-Bilder';

    private static $summary_fields = [
        'Title' => 'Titel',
        'SubTitle' => 'Untertitel',
        'Image.CMSThumbnail' => 'Bild',
        'SortOrder' => 'Reihenfolge',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $translate = [
        'Title',
        'SubTitle',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title', 'Titel'),
            TextField::create('SubTitle', 'Untertitel'),
            UploadField::create('Image', 'Bild')
                ->setFolderName('HeroSlides'),
        );

        // This line is necessary, and only AFTER you have added your fields
        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    #[Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        // Automatische SortOrder-Vergabe
        if (!$this->SortOrder) {
            $maxOrder = HeroSlide::get()
                ->filter('ParentID', $this->ParentID)
                ->max('SortOrder');
            $this->SortOrder = $maxOrder ? $maxOrder + 1 : 1;
        }
    }

    #[Override]
    public function getTitle()
    {
        // Verwende das Standard-Field-Accessor Pattern
        $title = $this->getField('Title');
        if (!empty($title)) {
            return $title;
        }

        // Fallback zu HeroSlide mit ID
        return 'HeroSlide' . ($this->ID ? ' #' . $this->ID : '');
    }
}
