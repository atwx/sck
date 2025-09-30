<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;

/**
 * Class \Atwx\Sck\Extensions\PhotoGalleryExtension
 *
 * @property \PurpleSpider\BasicGalleryExtension\PhotoGalleryImage|\Atwx\Sck\Extensions\PhotoGalleryExtension $owner
 * @property string $FontColor
 * @property int $ButtonID
 * @method Link Button()
 */
class PhotoGalleryExtension extends Extension
{

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('ButtonID');
        $fields->addFieldToTab(
            'Root.Main',
            LinkField::create('Button')
        );

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('FontColor', self::$field_labels['FontColor'])
                ->setAttribute('type', 'color')
                ->setDescription('Farbe für den Titel auswählen'),
        );
    }
    private static $db = [
        'FontColor' => 'Varchar(7)',
    ];

    private static $field_labels = [
        'FontColor' => 'Schriftfarbe',
    ];

    private static $has_one = [
        'Button' => Link::class,
    ];
}
