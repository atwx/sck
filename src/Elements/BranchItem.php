<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\LinkField\Form\LinkField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\LinkField\Models\Link;

/**
 * Class \Atwx\Sck\Elements\BranchItem
 *
 * @property string $Title
 * @property string $Content
 * @property int $ImageID
 * @property int $ButtonID
 * @property int $BranchesElementID
 * @method Image Image()
 * @method Link Button()
 * @method BranchesElement BranchesElement()
 */
class BranchItem extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'Button' => Link::class,
        'BranchesElement' => BranchesElement::class,
    ];

    private static $owns = [
        'Image',
        'Button',
    ];

    private static $field_labels = [
        'Title' => 'Überschrift',
        'Content' => 'Text',
        'Image' => 'Bild',
        'Button' => 'Button',
    ];

    private static $table_name = 'SCK_BranchItem';

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Bild',
        'Title' => 'Titel',
        'Content.Summary' => 'Inhalt',
    ];

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('BranchesElementID');
        $fields->removeByName('ButtonID');

        $fields->addFieldToTab('Root.Main', $fields->dataFieldByName('Title'));
        $fields->addFieldToTab('Root.Main', $fields->dataFieldByName('Image'));
        $fields->addFieldToTab('Root.Main', $fields->dataFieldByName('Content'));
        $fields->addFieldToTab('Root.Main', LinkField::create('Button', 'Button'));

        return $fields;
    }
}
