<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use StevenPaw\SilverstripeStyleguide\Extensions\PlaceholderHelper;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\DropdownField;

class AccordionElement extends BaseElement
{

    private static $db = [
        "Text" => "HTMLText",
        "Columns" => "Varchar(20)",
    ];

    private static $has_many = [
        "Items" => AccordionItem::class,
    ];

    private static $field_exclude = [
        'Columns',
    ];

    private static $field_labels = [
        'Text' => 'Text',
        'Items' => 'Accordion Items',
        'Columns' => 'Spaltenanzahl',
    ];

    private static $owns = [
        "Items",
    ];

    private static $table_name = 'AccordionElement';
    private static $icon = 'font-icon-down-open-big';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Accordion";
    }

    #[Override]
    public function getSummary(): string
    {
        return 'Element with Text in accordion style';
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->Text ? $this->dbObject('Text')->Plain() : "No text";
        return $blockSchema;
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Items');

        $fields->addFieldToTab('Root.Main', DropdownField::create('Columns', 'Spaltenanzahl', [
            '' => '2',
            'columns--three' => '3',
            'columns--four' => '4',
        ]));

        $gridfield = GridField::create(
            "Items",
            $this->fieldLabel('Items'),
            $this->Items(),
            GridFieldConfig_RecordEditor::create()
        );
        $gridfield->getConfig()->addComponent(GridFieldOrderableRows::create('SortField'));
        
        // Set the schema component to ensure compatibility with React admin
        $gridfield->setSchemaComponent('GridField');
        
        $fields->addFieldToTab('Root.Main', $gridfield);

        return $fields;
    }

    /**
     * Custom placeholder data for TextImageElement
     */
    public function providePlaceholderData()
    {

        return [
            'Title' => 'Accordion Element',
            'ShowTitle' => true,
            'Text' =>  PlaceholderHelper::createPlaceholderText(180),
        ];
    }

    public function getSearchableContent()
    {
        $content = $this->Text;
        foreach ($this->Items() as $item) {
            $content .= ' ' . $item->getSearchableContent();
        }
        return $content;
    }
}
