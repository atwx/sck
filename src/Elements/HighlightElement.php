<?php

namespace Atwx\Sck\Elements;

use Override;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\LinkField\Form\MultiLinkField;
use SilverStripe\LinkField\Models\Link;

class HighlightElement extends BaseElement
{
    private static $db = [
        "Content" => "HTMLText",
    ];

    private static $has_many = [
        'Buttons' => Link::class,
    ];

    private static $owns = [
        'Buttons',
    ];

    private static $field_labels = [
        'Content' => 'Inhalt',
        'Buttons' => 'Buttons',
    ];

    private static $table_name = 'SCK_HighlightElement';
    private static $icon = 'font-icon-fast-forward';
    private static $inline_editable = true;

    #[Override]
    public function getType()
    {
        return "Highlight";
    }

    #[Override]
    public function getSummary(): string
    {
        $summary = [];

        if ($this->Content) {
            $summary[] = "Inhalt: " . $this->Content;
        }

        return $summary === [] ? 'Highlight-Element' : implode(', ', $summary);
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content', $this->fieldLabel('Content'))
                ->setDescription('Text über den Links'),
                MultiLinkField::create(
                    'Buttons',
                    $this->fieldLabel('Buttons'),
                    $this->Buttons()
                )->setDescription('Fügen Sie hier Buttons hinzu'),
        ]);

        return $fields;
    }
}
