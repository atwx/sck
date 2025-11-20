<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\DropdownField;
use TractorCow\Fluent\Extension\FluentExtension;

class CardSlide extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'BackgroundColor' => 'Varchar(31)',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
        'CardSliderElement' => CardSliderElement::class,
        'Button' => Link::class,
    ];

    private static $owns = [
        'BackgroundImage',
        'Button',
    ];

    private static $cascade_deletes = [
        'BackgroundImage',
        'Button',
    ];

    private static $cascade_duplicate = [
        'BackgroundImage',
        'Button',
    ];

    private static $default_sort = 'SortOrder ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'Content' => 'Inhalt/Beschreibung',
        'BackgroundImage' => 'Hintergrundbild',
        'SortOrder' => 'Reihenfolge',
    ];

    private static $table_name = 'SCK_CardSlide';
    private static $singular_name = 'Karte';
    private static $plural_name = 'Karten';

    private static $summary_fields = [
        'Title' => 'Titel',
        'Content.Summary' => 'Inhalt',
        'BackgroundImage.CMSThumbnail' => 'Bild',
        'SortOrder' => 'Reihenfolge',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $translate = [
        'Title',
        'Content',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title', 'Titel')
                ->setDescription('Der Haupttitel der Kachel (z.B. "Fördermittelberatung")'),
            TextareaField::create('Content', 'Inhalt/Beschreibung')
                ->setRows(4)
                ->setDescription('Beschreibungstext für die Kachel'),
            UploadField::create('BackgroundImage', 'Hintergrundbild')
                ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                ->setAllowedMaxFileNumber(1)
                ->setIsMultiUpload(false)
                ->setDescription('Empfohlene Größe: 400x300px für optimale Darstellung'),
            LinkField::create('Button', 'Button')
                ->setDescription('Button für weitere Informationen'),
            DropdownField::create('BackgroundColor', 'Hintergrundfarbe')
                ->setSource([
                    '' => 'Keine Farbe',
                    'bg-color-white' => 'Weiß',
                    'bg-color-primary' => 'Primärfarbe',
                    'bg-color-secondary' => 'Sekundärfarbe',
                ])
                ->setEmptyString('-- Bitte wählen --')
                ->setDescription('Wählen Sie eine Hintergrundfarbe für die Kachel aus'),
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
            $maxOrder = CardSlide::get()
                ->filter('CardSliderElementID', $this->CardSliderElementID)
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

        // Fallback zu Karte mit ID
        return 'Karte' . ($this->ID ? ' #' . $this->ID : '');
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
