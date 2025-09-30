<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataObject;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Class \Atwx\Sck\Elements\NewsItem
 *
 * @property string $Title
 * @property string $Content
 * @property int $LinkID
 * @property int $ParentID
 * @method Link Link()
 * @method NewsElement Parent()
 */
class NewsItem extends DataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
        "Content" => "HTMLText",
    ];

    private static $has_one = [
        'Link' => Link::class,
        'Parent' => NewsElement::class,
    ];

    private static $owns = [
        'Link',
    ];

    private static $field_labels = [
        'Title' => 'Titel',
        "Content" => "Beschreibung",
        'Link' => 'Link (optional)',
    ];

    private static $summary_fields = [
        'Title' => 'Titel',
        'Content.Summary' => 'Beschreibung',
    ];

    private static $table_name = 'NewsItem';
    private static $singular_name = "News Eintrag";
    private static $plural_name = "News Einträge";

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['ParentID', 'LinkID']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', 'Titel')
                ->setDescription('Der Titel des News-Eintrags'),
            HTMLEditorField::create('Content', 'Beschreibung')
                ->setRows(4)
                ->setDescription('Eine kurze Beschreibung des News-Eintrags'),
            LinkField::create('Link', 'Link')
                ->setDescription('Optional: Ein Link zu weiteren Informationen')
        ]);

        return $fields;
    }

    #[Override]
    public function getTitle()
    {
        return $this->getField('Title') ?: 'Neuer News Eintrag';
    }
}
