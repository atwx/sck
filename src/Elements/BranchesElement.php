<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataList;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * Class \Atwx\Sck\Elements\BranchesElement
 *
 * @method DataList|BranchItem[] BranchItems()
 */
class BranchesElement extends BaseElement
{
    private static $has_many = [
        'BranchItems' => BranchItem::class,
    ];

    private static $owns = [
        'BranchItems',
    ];

    private static $field_labels = [
        'Title' => 'Überschrift',
        'BranchItems' => 'Branchen-Einträge',
    ];

    private static $table_name = 'BranchesElement';
    private static $icon = 'font-icon-block-layout';
    private static $inline_editable = false;

    #[Override]
    public function getType()
    {
        return "Branchen";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Title) {
            $summary[] = "Titel: " . $this->Title;
        }

        $itemCount = $this->BranchItems()->count();
        if ($itemCount > 0) {
            $summary[] = $itemCount . " Einträge";
        }

        return implode(" | ", $summary) ?: "Branchen Element";
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($this->ID) {
            $config = GridFieldConfig_RecordEditor::create();
            $gridField = GridField::create(
                'BranchItems',
                'Branchen-Einträge',
                $this->BranchItems(),
                $config
            );
            $fields->addFieldToTab('Root.Main', $gridField);
        } else {
            $fields->addFieldToTab('Root.Main',
                LiteralField::create(
                    'BranchItemsNote',
                    '<p class="message notice">Speichern Sie das Element zuerst, um Einträge hinzuzufügen.</p>'
                )
            );
        }

        return $fields;
    }
}
