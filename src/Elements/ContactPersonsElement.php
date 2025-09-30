<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;

/**
 * Class \Atwx\Sck\Elements\ContactPersonsElement
 *
 * @property string $MainTitle
 * @property string $Person1Name
 * @property string $Person1Position
 * @property string $Person1Department
 * @property string $Person1Phone
 * @property string $Person1Mobile
 * @property string $Person1Email
 * @property string $Person2Name
 * @property string $Person2Position
 * @property string $Person2Department
 * @property string $Person2Phone
 * @property string $Person2Mobile
 * @property string $Person2Email
 * @property int $Person1ImageID
 * @property int $Person2ImageID
 * @method Image Person1Image()
 * @method Image Person2Image()
 */
class ContactPersonsElement extends BaseElement
{
    private static $db = [
        'MainTitle' => 'Varchar(255)',
        'Person1Name' => 'Varchar(255)',
        'Person1Position' => 'Varchar(255)',
        'Person1Department' => 'Varchar(255)',
        'Person1Phone' => 'Varchar(50)',
        'Person1Mobile' => 'Varchar(50)',
        'Person1Email' => 'Varchar(255)',
        'Person2Name' => 'Varchar(255)',
        'Person2Position' => 'Varchar(255)',
        'Person2Department' => 'Varchar(255)',
        'Person2Phone' => 'Varchar(50)',
        'Person2Mobile' => 'Varchar(50)',
        'Person2Email' => 'Varchar(255)',
    ];

    private static $has_one = [
        'Person1Image' => Image::class,
        'Person2Image' => Image::class,
    ];

    private static $owns = [
        'Person1Image',
        'Person2Image',
    ];

    private static $cascade_deletes = [
        'Person1Image',
        'Person2Image',
    ];

    private static $field_labels = [
        'MainTitle' => 'Haupttitel',
        'Person1Name' => 'Name Person 1',
        'Person1Position' => 'Position Person 1',
        'Person1Department' => 'Abteilung Person 1',
        'Person1Phone' => 'Telefon Person 1',
        'Person1Mobile' => 'Mobil Person 1',
        'Person1Email' => 'E-Mail Person 1',
        'Person1Image' => 'Foto Person 1',
        'Person2Name' => 'Name Person 2',
        'Person2Position' => 'Position Person 2',
        'Person2Department' => 'Abteilung Person 2',
        'Person2Phone' => 'Telefon Person 2',
        'Person2Mobile' => 'Mobil Person 2',
        'Person2Email' => 'E-Mail Person 2',
        'Person2Image' => 'Foto Person 2',
    ];

    private static $table_name = 'ContactPersonsElement';
    private static $icon = 'font-icon-torsos-all';
    private static $singular_name = 'Kontaktpersonen Element';
    private static $plural_name = 'Kontaktpersonen Elemente';

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('MainTitle', 'Haupttitel')
                ->setDescription('Der Haupttitel über den Kontaktpersonen (z.B. "Stadt Cuxhaven")'),
        ]);

        $fields->addFieldsToTab('Root.Person 1', [
            TextField::create('Person1Name', 'Name')
                ->setDescription('Vollständiger Name der ersten Person'),

            TextField::create('Person1Position', 'Position')
                ->setDescription('Berufsbezeichnung (z.B. "Dipl.-Verwaltungswirt")'),

            TextField::create('Person1Department', 'Abteilung')
                ->setDescription('Abteilung oder Bereich (z.B. "Stadt, Fördermittelberatung (GRW)")'),

            TextField::create('Person1Phone', 'Telefon')
                ->setDescription('Telefonnummer (z.B. "+49 (0) 4721 / 599-719")'),

            TextField::create('Person1Mobile', 'Mobil')
                ->setDescription('Mobilnummer (optional)'),

            EmailField::create('Person1Email', 'E-Mail')
                ->setDescription('E-Mail-Adresse'),

            UploadField::create('Person1Image', 'Foto')
                ->setAllowedExtensions(['jpg', 'jpeg', 'png'])
                ->setFolderName('contact-persons')
                ->setDescription('Profilfoto der Person (idealerweise quadratisch)')
        ]);

        $fields->addFieldsToTab('Root.Person 2', [
            TextField::create('Person2Name', 'Name')
                ->setDescription('Vollständiger Name der zweiten Person'),

            TextField::create('Person2Position', 'Position')
                ->setDescription('Berufsbezeichnung'),

            TextField::create('Person2Department', 'Abteilung')
                ->setDescription('Abteilung oder Bereich'),

            TextField::create('Person2Phone', 'Telefon')
                ->setDescription('Telefonnummer'),

            TextField::create('Person2Mobile', 'Mobil')
                ->setDescription('Mobilnummer (optional)'),

            EmailField::create('Person2Email', 'E-Mail')
                ->setDescription('E-Mail-Adresse'),

            UploadField::create('Person2Image', 'Foto')
                ->setAllowedExtensions(['jpg', 'jpeg', 'png'])
                ->setFolderName('contact-persons')
                ->setDescription('Profilfoto der Person (idealerweise quadratisch)')
        ]);

        return $fields;
    }

    #[Override]
    public function getType()
    {
        return 'Kontaktpersonen';
    }

    #[Override]
    public function getTitle()
    {
        return $this->MainTitle ?: 'Kontaktpersonen Element';
    }

    #[Override]
    public function getSummary()
    {
        $summary = [];

        if ($this->MainTitle) {
            $summary[] = "Titel: " . $this->MainTitle;
        }

        $personCount = 0;
        if ($this->Person1Name) {
            $personCount++;
            $summary[] = "Person 1: " . $this->Person1Name .
                         ($this->Person1Position ? " (" . $this->Person1Position . ")" : "");
        }

        if ($this->Person2Name) {
            $personCount++;
            $summary[] = "Person 2: " . $this->Person2Name .
                         ($this->Person2Position ? " (" . $this->Person2Position . ")" : "");
        }

        if ($personCount == 0) {
            $summary[] = "Keine Personen konfiguriert";
        }

        return implode(" | ", $summary) ?: "Kontaktpersonen Element";
    }
}
