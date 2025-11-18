<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;

/**
 * Class \Atwx\Sck\Extensions\CustomSiteConfig
 *
 * @property SiteConfig|\Atwx\Sck\Extensions\CustomSiteConfig $owner
 * @property string $LinkYouTube
 * @property string $LinkInstagram
 * @property string $LinkFacebook
 * @property string $LinkTwitter
 * @property string $LinkDiscord
 * @property string $ColorPrimary
 * @property string $ColorSecondary
 * @property string $ColorText
 * @property string $ColorHeadline
 * @property string $MaxWidth
 * @property string $MaxWidthContent
 * @property string $FooterText
 * @property string $CustomCSS
 * @property int $LogoID
 * @property int $FaviconID
 * @method File Logo()
 * @method Image Favicon()
 */
class CustomSiteConfig extends Extension
{

    public $owner;
    private static $db = [
        'LinkYouTube' => 'Varchar(255)',
        'LinkInstagram' => 'Varchar(255)',
        'LinkFacebook' => 'Varchar(255)',
        'LinkTwitter' => 'Varchar(255)',
        'LinkDiscord' => 'Varchar(255)',
        'ColorPrimary' => 'Varchar(7)',
        'ColorPrimaryFontWhite' => 'Boolean',
        'ColorSecondary' => 'Varchar(7)',
        'ColorSecondaryFontWhite' => 'Boolean',
        'ColorText' => 'Varchar(7)',
        'ColorHeadline' => 'Varchar(7)',
        'ColorBackground' => 'Varchar(7)',
        'LinkStyle' => 'Varchar(50)',
        'MenuBackgroundColor' => 'Varchar(7)',
        'MenuButtonColor' => 'Varchar(7)',
        'MenuTextColor' => 'Varchar(7)',
        'MenuTextHoverColor' => 'Varchar(7)',
        'MaxWidth' => 'Varchar(10)',
        'MaxWidthContent' => 'Varchar(10)',
        'FooterText' => 'HTMLText',
        'CustomCSS' => 'Text',
        'HeaderFont' => 'Varchar(100)',
        'BodyFont' => 'Varchar(100)',
    ];

    private static $has_one = [
        'Logo' => File::class,
        'WhiteLogo' => File::class,
        'FooterLogo' => File::class,
        'Favicon' => File::class,
        'SocialImage' => Image::class,
        'AppleTouchIcon' => File::class,
        'Arrow' => File::class
    ];

    private static $owns = [
        'Logo',
        'WhiteLogo',
        'FooterLogo',
        'Favicon',
        'SocialImage',
        'AppleTouchIcon',
        'Arrow',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        // Socials Tab
        $fields->addFieldToTab("Root.Socials", new TextField("LinkYouTube", "YouTube"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkInstagram", "Instagram"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkFacebook", "Facebook"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkTwitter", "Twitter"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkDiscord", "Discord"));

        // Icons Tab
        $fields->addFieldToTab("Root.Icons", new UploadField("Logo", "Logo"));
        $fields->addFieldToTab("Root.Icons", new UploadField("Favicon", "Favicon"));
        $fields->addFieldToTab("Root.Icons", new UploadField("AppleTouchIcon", "Apple Touch Icon"));
        $fields->addFieldToTab("Root.Icons", new UploadField("SocialImage", "Social Image"));

        // Layout Tab
        $fields->addFieldToTab("Root.Layout", TextField::create("MaxWidth", "Maximale Breite")
            ->setDescription("Maximale Breite des Contents (z.B. 1200px, 100%, 1400px)")
            ->setAttribute('placeholder', '1200px'));
        $fields->addFieldToTab("Root.Layout", TextField::create("MaxWidthContent", "Maximale Content-Breite")
            ->setDescription("Maximale Breite für Text-Content (z.B. 980px, 800px)")
            ->setAttribute('placeholder', '980px'));

        $fields->addFieldToTab("Root.Main", new HTMLEditorField("FooterText", "Footer Text"));

        // Styling Tab
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorPrimary", "Primärfarbe")
            ->setDescription("Hauptfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", CheckboxField::create("ColorPrimaryFontWhite", "Weiße Schrift auf Primärfarbe")
            ->setDescription("Überschreibt die Textfarben mit weiß, wenn sie auf der Primärfarbe liegen"));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorSecondary", "Sekundärfarbe")
            ->setDescription("Sekundärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", CheckboxField::create("ColorSecondaryFontWhite", "Weiße Schrift auf Sekundärfarbe")
            ->setDescription("Überschreibt die Textfarben mit weiß, wenn sie auf der Sekundärfarbe liegen"));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorHeadline", "Überschriftfarbe")
            ->setDescription("Farbe der Überschriften")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorText", "Textfarbe")
            ->setDescription("Farbe des Fließtextes")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorBackground", "Hintergrundfarbe")
            ->setDescription("Hintergrundfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", UploadField::create("Arrow", "Pfeil nach rechts")
            ->setDescription("Ein Pfeil zur Navigation in Slidern"));
        $fields->addFieldToTab("Root.Styling", DropdownField::create('LinkStyle', 'Link Style', [
            'underline' => 'Unterstrichen',
            'triangle_primary' => 'Dreieck Primärfarbe',
            'triangle_secondary' => 'Dreieck Sekundärfarbe',
        ])
            ->setDescription("Stil der Links auf der Website"));

        // Fonts Tab
        $fields->addFieldToTab("Root.Schriften.Header", DropdownField::create('HeaderFont', 'Header Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
        ]));
        $fields->addFieldToTab("Root.Schriften.Body", DropdownField::create('BodyFont', 'Body Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
        ]));

        // Custom Tab
        $fields->addFieldToTab("Root.Custom", new TextareaField("CustomCSS", "Custom CSS"));
    }

    public function getMaxWidthValue()
    {
        return $this->owner->MaxWidth ?: '1200px';
    }

    public function getMaxWidthContentValue()
    {
        return $this->owner->MaxWidthContent ?: '980px';
    }

    public function getColorPrimaryValue()
    {
        return $this->owner->ColorPrimary ?: '#03395E';
    }

    public function getColorSecondaryValue()
    {
        return $this->owner->ColorSecondary ?: '#63819C';
    }

    public function getColorTextValue()
    {
        return $this->owner->ColorText ?: '#464F54';
    }

    public function getColorHeadlineValue()
    {
        return $this->owner->ColorHeadline ?: '#03395E';
    }
}
