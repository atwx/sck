<?php

namespace Atwx\Sck\Models;

use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\SiteConfig\SiteConfig;

class FooterColumn extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Width' => 'Varchar(31)',
        'SortOrder' => 'Int',
        'ShowTitle' => 'Boolean',
    ];

    private static $has_one = [
        'Parent' => SiteConfig::class,
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
        'Content' => 'Inhalt/Beschreibung',
        'Image' => 'Bild',
        'SortOrder' => 'Reihenfolge',
        'Width' => 'Breite',
    ];

    private static $table_name = 'SCK_FooterColumn';
    private static $singular_name = 'Footerspalte';
    private static $plural_name = 'Footerspalten';

    private static $summary_fields = [
        'Title' => 'Titel',
        'Content.Summary' => 'Inhalt',
        'Image.CMSThumbnail' => 'Bild',
        'SortOrder' => 'Reihenfolge',
    ];

    private static $translate = [
        'Title',
        'Content',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextCheckboxGroupField::create('Title', 'Titel')
                ->setDescription('Der Haupttitel der Spalte im Footer'),
            HTMLEditorField::create('Content', 'Inhalt')
                ->setRows(4)
                ->setDescription('Inhalt für die Spalte im Footer'),
            UploadField::create('Image', 'Bild')
                ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                ->setAllowedMaxFileNumber(1)
                ->setIsMultiUpload(false),
            DropdownField::create('Width', 'Breite', [
                '20%' => '20%',
                '25%' => '25%',
                '33%' => '33%',
                '40%' => '40%',
                '50%' => '50%',
                '66%' => '66%',
                '75%' => '75%',
                '90%' => '90%',
                '100%' => '100%',
            ])->setDescription('Breite der Footerspalte (z.B. 25% für 4 Spalten)')
        );

        $fields->removeByName('SortOrder');

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
            $maxOrder = FooterColumn::get()
                ->max('SortOrder');
            $this->SortOrder = $maxOrder ? $maxOrder + 1 : 1;
        }
    }

    /**
     * Overrides the default Title property for GridField display
     */
    #[Override]
    public function summaryFields()
    {
        return [
            'Title' => 'Titel',
            'Content.Summary' => 'Inhalt',
        ];
    }
}
