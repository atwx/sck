<?php

namespace Atwx\Sck\People;

use Override;
use Atwx\Sck\Events\Event;
use SilverStripe\Assets\Image;
use Atwx\Sck\People\PersonGroup;
use Atwx\Sck\Elements\PersonElement;
use Atwx\Sck\Tags\TaggableDataObject;
use SilverStripe\Forms\CheckboxSetField;

class Person extends TaggableDataObject
{
    private static $db = [
        "DoctoralDegree" => "Varchar(255)",
        "FirstName" => "Varchar(255)",
        "SecondName" => "Varchar(255)",
        "LastName" => "Varchar(255)",
        "Telephone" => "Varchar(255)",
        "Email" => "Varchar(255)",
        "Function" => "Varchar(255)",
        "Street" => "Varchar(255)",
        "PostalCode" => "Varchar(255)",
        "City" => "Varchar(255)",
        "Country" => "Varchar(255)",
        "OfficeHours" => "Varchar(255)",
    ];

    private static $has_one = [
        "Image" => Image::class,
    ];

    private static $many_many = [
        'Groups' => PersonGroup::class,
    ];

    private static $belongs_many_many = [
        'Elements' => PersonElement::class,
        'Events' => Event::class,
    ];

    private static $owns = [
        "Image",
    ];

    private static $default_sort = 'FirstName ASC';

    private static $field_labels = [
        'DoctoralDegree' => 'Titel',
        'FirstName' => 'Vorname',
        'SecondName' => 'Zweiter Vorname',
        'LastName' => 'Nachname',
        'Telephone' => 'Telefon',
        'Email' => 'E-Mail',
        'Function' => 'Funktion',
        'Street' => 'Straße',
        'PostalCode' => 'Postleitzahl',
        'City' => 'Ort',
        'Country' => 'Land',
        'OfficeHours' => 'Sprechzeiten',
        'Image' => 'Bild',
        'Groups' => 'Personengruppen',
    ];

    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email',
        'Function',
        'Groups.Title',
    ];

    private static $table_name = 'SCK_Person';
    private static $singular_name = 'Person';
    private static $plural_name = 'Personen';

    private static $summary_fields = [
        'Thumbnail' => 'Bild',
        'Title' => 'Titel',
        'Address' => 'Adresse',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        //Replace Personengruppen field with CheckboxSetField
        $fields->replaceField('Groups', CheckboxSetField::create(
            'Groups',
            _t(self::class . '.Groups', self::$field_labels['Groups']),
            PersonGroup::get()->map('ID', 'Title')->toArray()
        ));
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
        $title = "";
        if (!empty($this->getField('DoctoralDegree'))) {
            $title .= $this->getField('DoctoralDegree') . " ";
        }
        if (!empty($this->getField('FirstName'))) {
            $title .= $this->getField('FirstName') . " ";
        }
        if (!empty($this->getField('LastName'))) {
            $title .= $this->getField('LastName') . " ";
        }
        if (!empty($title)) {
            return $title;
        }

        // Fallback zu News Eintrag mit ID
        return 'Person' . ($this->ID ? ' #' . $this->ID : '');
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
