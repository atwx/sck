<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\LinkField\Models\Link;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;

/**
 * Class \Atwx\Sck\Extensions\LinkExtension
 *
 * @property Link|\Atwx\Sck\Extensions\LinkExtension $owner
 * @property string $Variant
 */
class LinkExtension extends Extension
{
    private static $db = [
        "Variant" => "Varchar(255)",
    ];

    private static $defaults = [
        "Variant" => "primary"
    ];

    private static $field_labels = [
        "Variant" => "Button Variant"
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create(
                'Variant',
                _t(self::class . '.Variant', self::$field_labels['Variant']),
                [
                    'primary' => 'Primärer Button',
                    'secondary' => 'Sekundärer Button',
                    // 'success' => 'Erfolg',
                    // 'danger' => 'Gefahr',
                    // 'warning' => 'Warnung',
                    // 'info' => 'Info',
                    // 'text' => 'Text',
                    'readmore' => 'Pfeilprefix',
                    'readmore_round' => 'Pfeilprefix rund',
                ]
            )
        );
        return $fields;
    }
}
