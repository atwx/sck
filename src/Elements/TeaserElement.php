<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataList;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class \Atwx\Sck\Elements\TeaserElement
 *
 * @method DataList|TeaserItem[] TeaserItems()
 */
class TeaserElement extends BaseElement
{
    private static $has_many = [
        'TeaserItems' => TeaserItem::class,
    ];

    private static $owns = [
        'TeaserItems',
    ];

    private static $field_labels = [
        'Title' => 'Überschrift',
        'TeaserItems' => 'Teaser-Einträge',
    ];

    private static $table_name = 'SCK_TeaserElement';
    private static $icon = 'font-icon-block-layout';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Teaser";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        $itemCount = $this->TeaserItems()->count();
        if ($itemCount > 0) {
            $summary[] = $itemCount . " Einträge";
        }

        return implode(" | ", $summary) ?: "Teaser Element";
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        
        $fields->removeByName(['TeaserItems']);

        if ($this->ID) {
            $config = GridFieldConfig_RecordEditor::create();
            $gridField = GridField::create(
                'TeaserItems',
                'Teaser-Einträge',
                $this->TeaserItems(),
                $config
            );
            $gridField->getConfig()->addComponent(GridFieldOrderableRows::create('SortOrder'));
            $fields->addFieldToTab('Root.Main', $gridField);
        } else {
            $fields->addFieldToTab('Root.Main',
                LiteralField::create(
                    'TeaserItemsNote',
                    '<p class="message notice">Speichern Sie das Element zuerst, um Einträge hinzuzufügen.</p>'
                )
            );
        }

        return $fields;
    }
}
