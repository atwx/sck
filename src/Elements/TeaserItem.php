<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Models\Link;
use TractorCow\Fluent\Extension\FluentExtension;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Class \Atwx\Sck\Elements\TeaserItem
 *
 * @property string $Title
 * @property string $Content
 * @property int $ImageID
 * @property int $ButtonID
 * @property int $ParentID
 * @method Image Image()
 * @method Link Button()
 * @method TeaserElement Parent()
 */
class TeaserItem extends DataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
        "Content" => "HTMLText",
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Button' => Link::class,
        'Parent' => TeaserElement::class,
    ];

    private static $owns = [
        'Image',
        'Button',
    ];

    private static $field_labels = [
        'Title' => 'Titel',
        "Content" => "Text",
        'Image' => 'Bild',
        'Button' => 'Button',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Bild',
        'Title' => 'Titel',
    ];

    private static $translate = [
        'Title',
        'Content',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $table_name = 'SCK_TeaserItem';
    private static $singular_name = "Teaser Eintrag";
    private static $plural_name = "Teaser Einträge";

    public function getCMSFields()
    {
        // Note the absence of any parent::getCMSFields
        $fields = FieldList::create(
            TextField::create('Title', 'Title', null, 255),
            HTMLEditorField::create('Content', 'Content')
        );

        // This line is necessary, and only AFTER you have added your fields
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }
}
