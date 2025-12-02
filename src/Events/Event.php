<?php

namespace Atwx\Sck\Events;

use Override;
use Atwx\Sck\People\Person;
use SilverStripe\Assets\Image;
use Atwx\Sck\Tags\TaggableDataObject;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\Forms\SearchableMultiDropdownField;

/**
 * @method Image Image()
 */
class Event extends TaggableDataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
        "Content" => "HTMLText",
        "ShortContent" => "Text",
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

    private static $has_many = [
        "Links" => Link::class,
    ];

    private static $many_many = [
        "People" => Person::class,
    ];

    private static $owns = [
        "Image",
        "Links",
    ];

    private static $default_sort = 'Start ASC';

    private static $field_labels = [
        'Title' => 'Titel',
        'Content' => 'Inhalt',
        'ShortContent' => 'Kurzinhalt',
        'Start' => 'Startdatum',
        'End' => 'Enddatum',
    ];

    private static $searchable_fields = [
        'Title',
        'Content',
        'ShortContent',
        'Start',
        'End',
        'Tags.Title',
    ];

    private static $table_name = 'SCK_Event';
    private static $singular_name = 'Termin';
    private static $plural_name = 'Termine';

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Bild',
        'Title' => 'Titel',
        'ShortContent' => 'Kurzinhalt',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'People'
        ]);
        $fields->addFieldToTab(
            'Root.Main', SearchableMultiDropdownField::create(
                'People',
                _t(self::class . '.People', 'People'),
                Person::get(),
                $this->People()->map('ID', 'ID')->toArray()
            )
        );
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

    public function RenderDateRange()
    {
        $startDate = date('d.m.Y H:i');
        $endDate = date('d.m.Y H:i');

        if ($this->Start && $this->End) {
            if (date('d.m.Y', strtotime($this->Start)) === date('d.m.Y', strtotime($this->End))) {
                // Same day, show only time for end date
                $endDate = date('H:i', strtotime($this->End));
            } else {
                // Different days, show full end date
                $endDate = date('d.m.Y H:i', strtotime($this->End));
            }
            $startDate = date('d.m.Y H:i', strtotime($this->Start));
            $endDate = date('d.m.Y H:i', strtotime($this->End));
            return sprintf('%s - %s', $startDate, $endDate);
        } elseif ($this->Start && !$this->End) {
            $startDate = date('d.m.Y H:i', strtotime($this->Start));
            return $startDate;
        } elseif (!$this->Start && $this->End) {
            $endDate = date('d.m.Y H:i', strtotime($this->End));
            return $endDate;
        } else {
            return '';
        }
    }

    public function getLink()
    {
        $eventspage = EventsPage::get()->first();
        if ($eventspage) {
            return $eventspage->Link('view/' . $this->ID);
        }
        return null;
    }
}
