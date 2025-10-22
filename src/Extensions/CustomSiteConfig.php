<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

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
 * @property string $ColorPrimaryLight
 * @property string $ColorSecondaryLight
 * @property string $ColorPrimaryDark
 * @property string $ColorSecondaryDark
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
        'ColorSecondary' => 'Varchar(7)',
        'ColorPrimaryLight' => 'Varchar(7)',
        'ColorSecondaryLight' => 'Varchar(7)',
        'ColorPrimaryDark' => 'Varchar(7)',
        'ColorSecondaryDark' => 'Varchar(7)',
        'ColorText' => 'Varchar(7)',
        'ColorHeadline' => 'Varchar(7)',
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
        'Favicon' => Image::class,
    ];

    private static $owns = [
        'Logo',
        'Favicon',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Socials", new TextField("LinkYouTube", "YouTube"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkInstagram", "Instagram"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkFacebook", "Facebook"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkTwitter", "Twitter"));
        $fields->addFieldToTab("Root.Socials", new TextField("LinkDiscord", "Discord"));

        $fields->addFieldToTab("Root.Layout", TextField::create("MaxWidth", "Maximale Breite")
            ->setDescription("Maximale Breite des Contents (z.B. 1200px, 100%, 1400px)")
            ->setAttribute('placeholder', '1200px'));
        $fields->addFieldToTab("Root.Layout", TextField::create("MaxWidthContent", "Maximale Content-Breite")
            ->setDescription("Maximale Breite für Text-Content (z.B. 980px, 800px)")
            ->setAttribute('placeholder', '980px'));

        $fields->addFieldToTab("Root.Styling", TextField::create("ColorPrimary", "Primärfarbe")
            ->setDescription("Hauptfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorSecondary", "Sekundärfarbe")
            ->setDescription("Sekundärfarbe der Website")
            ->setAttribute('type', 'color'));

        $fields->addFieldToTab("Root.Styling", TextField::create("ColorPrimaryLight", "Primärfarbe Hell")
            ->setDescription("Helle Variante der Primärfarbe")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorPrimaryDark", "Primärfarbe Dunkel")
            ->setDescription("Dunkle Variante der Primärfarbe")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorSecondaryLight", "Sekundärfarbe Hell")
            ->setDescription("Helle Variante der Sekundärfarbe")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorSecondaryDark", "Sekundärfarbe Dunkel")
            ->setDescription("Dunkle Variante der Sekundärfarbe")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorHeadline", "Überschriftfarbe")
            ->setDescription("Farbe der Überschriften")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling", TextField::create("ColorText", "Textfarbe")
            ->setDescription("Farbe des Fließtextes")
            ->setAttribute('type', 'color'));

        $fields->addFieldToTab("Root.Main", new HTMLEditorField("FooterText", "Footer Text"));
        $fields->addFieldToTab("Root.Main", new UploadField("Logo", "Logo"));
        $fields->addFieldToTab("Root.Main", new UploadField("Favicon", "Favicon"));
        $fields->addFieldToTab("Root.Styling", new TextareaField("CustomCSS", "Custom CSS"));
        $fields->addFieldToTab("Root.Fonts", DropdownField::create('HeaderFont', 'Header Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
        ]));
        $fields->addFieldToTab("Root.Fonts", DropdownField::create('BodyFont', 'Body Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
        ]));
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

    public function getColorPrimaryLightValue()
    {
        return $this->owner->ColorPrimaryLight ?: '#466892';
    }

    public function getColorPrimaryDarkValue()
    {
        return $this->owner->ColorPrimaryDark ?: '#0f1d30';
    }

    public function getColorSecondaryLightValue()
    {
        return $this->owner->ColorSecondaryLight ?: '#fad47a';
    }

    public function getColorSecondaryDarkValue()
    {
        return $this->owner->ColorSecondaryDark ?: '#806934';
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
