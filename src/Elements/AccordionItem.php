<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Form\LinkField;
use TractorCow\Fluent\Extension\FluentExtension;

class AccordionItem extends DataObject
{
    private static $db = [
        "Title" => "Varchar(255)",
        "IntroText" => "HTMLText",
        "Text" => "HTMLText",
        "ExpandText" => "Varchar(255)",
        "SortField" => "Int",
    ];

    private static $has_one = [
        'Parent' => AccordionElement::class,
        'Image' => Image::class,
        'Button' => Link::class,
    ];

    private static $owns = [
        'Image',
        'Button',
    ];

    private static $extensions = [
        FluentExtension::class,
    ];

    private static $field_labels = [
        'Title' => 'Title',
        'Image' => 'Image',
        'Button' => 'Button',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
    ];

    private static $default_sort = 'SortField ASC';
    private static $table_name = 'AccordionItem';
    private static $singular_name = "Accordion Entry";
    private static $plural_name = "Accordion Entries";

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ParentID');
        $fields->removeByName('ButtonID');
        $fields->removeByName('SortField');
        $fields->addFieldToTab('Root.Main', LinkField::create('Button'));
        return $fields;
    }

    public function onBeforeWrite() {
        parent::onBeforeWrite();
        if (!$this->SortField) {
            $maxSort = $this->get()->max('SortField');
            $this->SortField = $maxSort + 1;
            $this->write();
        }
    }

    public function getSearchableContent()
    {
        $content = $this->Title . ' ' . $this->Text;
        return $content;
    }

    public function canView($member = null)
    {
        return true;
    }

    public function canEdit($member = null)
    {
        return true;
    }

}
