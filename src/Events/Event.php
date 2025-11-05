<?php

namespace Atwx\Sck\Events;

use Override;
use SilverStripe\Assets\Image;
use Atwx\Sck\Tags\TaggableDataObject;

/**
 * @method Image Image()
 */
class Event extends TaggableDataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
        "Description" => "Text",
        "Start" => "Datetime",
        "End" => "Datetime",
        "Street" => "Varchar(255)",
        "PostalCode" => "Varchar(255)",
        "City" => "Varchar(255)",
        "Country" => "Varchar(255)",
    ];

    private static $has_one = [
        "Image" => Image::class,
    ];

    private static $owns = [
        "Image",
    ];

    private static $default_sort = 'Start ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'Description' => 'Beschreibung',
        'Start' => 'Startdatum',
        'End' => 'Enddatum',
    ];

    private static $searchable_fields = [
        'Title',
        'Description',
        'Start',
        'End',
        'Tags.Title',
    ];

    private static $table_name = 'SCK_Event';
    private static $singular_name = 'Termin';
    private static $plural_name = 'Termine';

    private static $summary_fields = [
        'Thumbnail' => 'Bild',
        'Title' => 'Titel',
        'Address' => 'Adresse',
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

    public function getAddress()
    {
        $addressParts = [];
        if (!empty($this->getField('Street'))) {
            $addressParts[] = $this->getField('Street');
        }
        $cityLine = '';
        if (!empty($this->getField('PostalCode'))) {
            $cityLine .= $this->getField('PostalCode') . ' ';
        }
        if (!empty($this->getField('City'))) {
            $cityLine .= $this->getField('City');
        }
        if (!empty($cityLine)) {
            $addressParts[] = trim($cityLine);
        }
        if (!empty($this->getField('Country'))) {
            $addressParts[] = $this->getField('Country');
        }
        return implode(', ', $addressParts);
    }

    public function getThumbnail()
    {
        if ($this->Image()->exists()) {
            return $this->Image()->CMSThumbnail();
        }
        return null;
    }
}
