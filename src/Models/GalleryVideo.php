<?php

namespace Atwx\Sck\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use Atwx\Sck\Elements\GalleryElement;

/**
 * Class \Atwx\Sck\Models\GalleryVideo
 *
 * @property string $VideoID
 * @property string $Title
 * @property int $SortOrder
 * @property int $GalleryElementID
 * @method GalleryElement GalleryElement()
 */
class GalleryVideo extends DataObject
{
    private static $db = [
        'VideoID'   => 'Varchar(20)',
        'Title'     => 'Varchar(255)',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'GalleryElement' => GalleryElement::class,
    ];

    private static $default_sort = 'SortOrder ASC';

    private static $table_name = 'SCK_GalleryVideo';

    private static $summary_fields = [
        'VideoID' => 'Video-ID',
        'Title'   => 'Titel',
    ];

    private static $field_labels = [
        'VideoID' => 'YouTube Video-ID',
        'Title'   => 'Titel',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['GalleryElementID', 'SortOrder']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('VideoID', 'YouTube Video-ID')
                ->setDescription('Nur die Video-ID eingeben, z. B. <code>szDgE-m1Uu8</code>'),
            TextField::create('Title', 'Titel (optional)'),
        ]);

        return $fields;
    }

    /**
     * YouTube embed URL for glightbox
     */
    public function EmbedURL(): string
    {
        return 'https://www.youtube-nocookie.com/embed/' . $this->VideoID;
    }

    /**
     * YouTube thumbnail URL
     */
    public function ThumbnailURL(): string
    {
        return 'https://img.youtube.com/vi/' . $this->VideoID . '/hqdefault.jpg';
    }
}
