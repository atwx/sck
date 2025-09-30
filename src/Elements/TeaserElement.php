<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\ORM\DataList;
use App\Elements\TeaserItem;
use DNADesign\Elemental\Models\BaseElement;

/**
 * Class \Atwx\Sck\Elements\TeaserElement
 *
 * @property string $Text
 * @method DataList|TeaserItem[] Teaser()
 */
class TeaserElement extends BaseElement
{

    private static $db = [
        "Text" => "HTMLText",
    ];

    private static $has_one = [];

    private static $has_many = [
        "Teaser" => TeaserItem::class,
    ];

    private static $owns = [];

    private static $field_labels = [
        "Text" => "Text",
    ];

    private static $table_name = 'TeaserElement';
    private static $icon = 'font-icon-block-promo-3';
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

        if ($this->Text) {
            $plainText = strip_tags($this->Text);
            $textPreview = strlen($plainText) > 40 ? substr($plainText, 0, 40) . "..." : $plainText;
            $summary[] = "Text: " . $textPreview;
        }

        $teaserCount = $this->Teaser()->count();
        $summary[] = $teaserCount . " Teaser" . ($teaserCount !== 1 ? "" : "");

        return implode(" | ", $summary) ?: "Teaser Element";
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->Text ? $this->dbObject('Text')->Plain() : "Kein Text";
        return $blockSchema;
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }
}
