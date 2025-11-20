<?php

namespace Atwx\Sck\Elements;

use Override;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\LinkField\Models\Link;
use SilverStripe\SiteConfig\SiteConfig;
//use TractorCow\SliderField\SliderField;
use SilverStripe\LinkField\Form\LinkField;
use DNADesign\Elemental\Models\BaseElement;

/**
 * Class \Atwx\Sck\Elements\IconCardElement
 *
 * @property string $Text
 * @property string $Alignment
 * @property string $VerticalPosition
 * @property string $HorizontalAlignment
 * @property string $ButtonColor
 * @property string $TextColor
 * @property string $TitleColor
 * @property float $BackgroundIntensity
 * @property string $BackgroundContentColor
 * @property int $BackgroundImageID
 * @property int $ButtonID
 * @property int $SymbolID
 * @method Image BackgroundImage()
 * @method Link Button()
 * @method File Symbol()
 */
class IconCardElement extends BaseElement
{
    private static $inline_editable = false;

    private static $db = [
        "Text" => "HTMLText",
        "Alignment" => "Enum('left,center,right','left')",
        "VerticalPosition" => "Enum('top,middle,bottom','middle')",
        "HorizontalAlignment" => "Enum('left,center,right','center')",
        "ButtonColor" => "Varchar(7)",
        "TextColor" => "Varchar(7)",
        "TitleColor" => "Varchar(7)",
        "BackgroundIntensity" => "Decimal(3,2)",
        "BackgroundContentColor" => "Varchar(7)",
    ];

    private static $has_one = [
        "BackgroundImage" => Image::class,
        "Button" => Link::class,
        "Symbol" => File::class,
    ];

    private static $owns = [
        "BackgroundImage",
        "Button",
    ];

    private static $defaults = [
        "BackgroundIntensity" => "0.4",
        "BackgroundColor" => "SiteColorPrimary",
    ];

    private static $field_labels = [
        "Title" => "Überschrift",
        "Text" => "Text",
        "Icon" => "Icon (CSS-Klasse oder SVG)",
        "BackgroundImage" => "Hintergrundbild",
        "Link" => "Link",
        "Alignment" => "Text-Ausrichtung",
        "VerticalPosition" => "Vertikale Position",
        "HorizontalAlignment" => "Horizontale Ausrichtung",
        "Symbol" => "Icon",
        "ButtonColor" => "Button-Farbe",
        "TextColor" => "Textfarbe",
        "TitleColor" => "Überschrift-Farbe",
        "BackgroundIntensity" => "Hintergrund-Intensität",
        "BackgroundContentColor" => "Hintergrundfarbe für Content",
    ];

    private static $table_name = 'SCK_IconCardElement';
    private static $icon = 'font-icon-block-content';

    #[Override]
    public function getType()
    {
        return "Icon Card";
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

        if ($this->Symbol && $this->Symbol->exists()) {
            $summary[] = "Icon: " . $this->Symbol->Name;
        }

        if ($this->BackgroundImage && $this->BackgroundImage->exists()) {
            $summary[] = "Hintergrundbild: " . $this->BackgroundImage->Name;
        }

        if ($this->Button && $this->Button->exists()) {
            $summary[] = "Button: " . $this->Button->Title;
        }

        $alignments = [
            'left' => 'Links',
            'center' => 'Zentriert',
            'right' => 'Rechts'
        ];
        $alignment = $alignments[$this->Alignment] ?? 'Links';
        $summary[] = "Ausrichtung: " . $alignment;

        return implode(" | ", $summary) ?: "Icon Card Element";
    }

    #[Override]
    public function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->Title ?: "Keine Überschrift";
        return $blockSchema;
    }

    public function SiteColorPrimary()
    {
        return SiteConfig::current_site_config()->ColorPrimary;
    }

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('ButtonID');
        $fields->addFieldsToTab('Root.Main', [
            LinkField::create('Button'),
        ]);

        $fields->addFieldsToTab('Root.Style', [
            DropdownField::create('Alignment', self::$field_labels['Alignment'], [
                'left' => 'Links',
                'center' => 'Zentriert',
                'right' => 'Rechts',
            ])->setDescription('Wähle, ob Text und Icon links, zentriert oder rechts angeordnet sind.'),
            DropdownField::create('VerticalPosition', self::$field_labels['VerticalPosition'], [
                'top' => 'Oben',
                'middle' => 'Mittig',
                'bottom' => 'Unten',
            ])->setDescription('Wähle, ob der Inhalt oben, mittig oder unten steht.'),
            DropdownField::create('HorizontalAlignment', self::$field_labels['HorizontalAlignment'], [
                'left' => 'Links',
                'center' => 'Zentriert',
                'right' => 'Rechts',
            ])->setDescription('Wähle, ob der Inhalt horizontal links, zentriert oder rechts ausgerichtet ist.'),
            TextField::create('ButtonColor', self::$field_labels['ButtonColor'])
                ->setAttribute('type', 'color'),
            TextField::create('TextColor', self::$field_labels['TextColor'])
                ->setAttribute('type', 'color'),
            TextField::create('TitleColor', self::$field_labels['TitleColor'])
                ->setAttribute('type', 'color'),
            TextField::create('BackgroundContentColor', self::$field_labels['BackgroundContentColor'])
                ->setAttribute('type', 'color')
        ]);

        return $fields;
    }
}
