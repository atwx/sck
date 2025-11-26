<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use TractorCow\Fluent\Extension\FluentExtension;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\LinkField\Form\MultiLinkField;

/**
 * Class \Atwx\Sck\Elements\TeaserItem
 *
 * @property string $Title
 * @property string $Content
 * @property int $ImageID
 * @property int $ButtonID
 * @property int $TeaserElementID
 * @method Image Image()
 * @method Link Button()
 * @method TeaserElement TeaserElement()
 */
class TeaserItem extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'Image' => Image::class,
        // 'Button' => Link::class,
        'TeaserElement' => TeaserElement::class,
    ];

    private static $has_many = [
        'Buttons' => Link::class,
    ];

    private static $owns = [
        'Image',
        // 'Button',
        'Buttons',
    ];

    private static $field_labels = [
        'Title' => 'Überschrift',
        'Content' => 'Text',
        'Image' => 'Bild',
        'Buttons' => 'Buttons',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $table_name = 'SCK_TeaserItem';
    private static $default_sort = 'SortOrder ASC';

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Bild',
        'Title' => 'Titel',
        'Content.Summary' => 'Inhalt',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title', 'Title', null, 255),
            HTMLEditorField::create('Content', 'Content'),
            UploadField::create('Image', 'Bild'),
            // LinkField::create('Button', 'Button')
            MultiLinkField::create('Buttons', 'Buttons')
        );

        // This line is necessary, and only AFTER you have added your fields
        $this->extend('updateCMSFields', $fields);

        return $fields;
    }
}
