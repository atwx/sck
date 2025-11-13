<?php

namespace Atwx\Sck\Elements;

use Override;
use Atwx\Sck\People\Person;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\SearchableMultiDropdownField;

/**
 * Class \Atwx\Sck\Elements\ContactPersonsElement
 *
 * @property string $Title
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
class PersonElement extends BaseElement
{
    private static $db = [
    ];

    private static $many_many = [
        'Persons' => Person::class,
    ];

    private static $field_labels = [
        'Title' => 'Titel',
        'Persons' => 'Personen',
    ];

    private static $table_name = 'SCK_PersonsElement';
    private static $icon = 'font-icon-torsos-all';
    private static $singular_name = 'Personen Element';
    private static $plural_name = 'Personen Elemente';
    private static $inline_editable = false;

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', 'Titel')
                ->setDescription('Der Titel über den Kontaktpersonen'),
        ]);
        $fields->addFieldToTab(
            'Root.Main',
            SearchableMultiDropdownField::create(
                'Persons',
                _t(self::class . '.Persons', self::$field_labels['Persons']),
                Person::get(),
                $this->Persons()->map('ID', 'ID')->toArray()
            )
        );

        return $fields;
    }

    #[Override]
    public function getType()
    {
        return 'Personen';
    }


    #[Override]
    public function getSummary()
    {
        $summary = [];

        $personCount = $this->Persons()->count();

        if ($personCount > 1) {
            $summary[] = $personCount . " Personen";
        } elseif ($personCount === 1) {
            $summary[] = $personCount . " Person: " . $this->Persons()->first()->getTitle();
        } else {
            $summary[] = "Keine Personen konfiguriert";
        }

        return implode(" | ", $summary) ?: "Personen Element";
    }
}
