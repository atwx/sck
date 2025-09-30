<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\LinkField\Models\Link;

/**
 * Class \Atwx\Sck\Elements\ServiceSlide
 *
 * @property string $Title
 * @property string $Content
 * @property int $SortOrder
 * @property int $BackgroundImageID
 * @property int $ServicesSliderElementID
 * @property int $ButtonID
 * @method Image BackgroundImage()
 * @method ServicesSliderElement ServicesSliderElement()
 * @method Link Button()
 */
class ServiceSlide extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
        'ServicesSliderElement' => ServicesSliderElement::class,
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

    private static $table_name = 'ServiceSlide';
    private static $singular_name = 'Service Kachel';
    private static $plural_name = 'Service Kacheln';

    private static $summary_fields = [
        'Title' => 'Titel',
        'Content.Summary' => 'Inhalt',
        'BackgroundImage.CMSThumbnail' => 'Bild',
        'SortOrder' => 'Reihenfolge',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['ServicesSliderElementID', 'SortOrder']);
        $fields->removeByName('ButtonID');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', 'Titel')
                ->setDescription('Der Haupttitel der Service-Kachel (z.B. "Fördermittelberatung")'),

            TextareaField::create('Content', 'Inhalt/Beschreibung')
                ->setRows(4)
                ->setDescription('Beschreibungstext für den Service'),

            UploadField::create('BackgroundImage', 'Hintergrundbild')
                ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                ->setAllowedMaxFileNumber(1)
                ->setIsMultiUpload(false)
                ->setDescription('Empfohlene Größe: 400x300px für optimale Darstellung'),

            LinkField::create('Button', 'Button')
                ->setDescription('Button für weitere Informationen'),
        ]);

        return $fields;
    }

    #[Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        // Automatische SortOrder-Vergabe
        if (!$this->SortOrder) {
            $maxOrder = ServiceSlide::get()
                ->filter('ServicesSliderElementID', $this->ServicesSliderElementID)
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

        // Fallback zu Service Kachel mit ID
        return 'Service Kachel' . ($this->ID ? ' #' . $this->ID : '');
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
