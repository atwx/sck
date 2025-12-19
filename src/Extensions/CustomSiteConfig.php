<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Forms\Tab;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TabSet;
use SilverStripe\Core\Extension;
use Atwx\Sck\Models\FooterColumn;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Core\Manifest\ModuleLoader;

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
        'ColorPrimaryLight' => 'Varchar(7)',
        'ColorPrimaryDark' => 'Varchar(7)',
        'ColorPrimaryFontWhite' => 'Boolean',
        'ColorSecondary' => 'Varchar(7)',
        'ColorSecondaryLight' => 'Varchar(7)',
        'ColorSecondaryDark' => 'Varchar(7)',
        'ColorSecondaryFontWhite' => 'Boolean',
        'ColorText' => 'Varchar(7)',
        'ColorHeadline' => 'Varchar(7)',
        'ColorBackground' => 'Varchar(7)',
        'ColorMenuBackground' => 'Varchar(7)',
        'ColorMenuText' => 'Varchar(7)',
        'ColorMenuTextHover' => 'Varchar(7)',
        'MenuButtonColor' => 'Varchar(7)',
        'MaxWidth' => 'Varchar(10)',
        'MaxWidthContent' => 'Varchar(10)',
        'MaxWidthBlockText' => 'Varchar(10)',
        'ShowBreadcrumbs' => 'Boolean',
        'FooterText' => 'HTMLText',
        'CustomCSS' => 'Text',
        'HeaderFont' => 'Varchar(100)',
        'BodyFont' => 'Varchar(100)',
        'HeaderVariant' => 'Varchar(100)',
        'HeaderMenuAlignment' => 'Varchar(31)',
        'FooterMenuAlignment' => 'Varchar(31)',
        'LanguageToggleVariant' => 'Varchar(100)',
    ];

    private static $has_one = [
        'HeaderLogo' => File::class,
        'FooterLogo' => File::class,
        'WhiteLogo' => File::class,
        'FooterLogo' => File::class,
        'Favicon' => File::class,
        'SocialImage' => Image::class,
        'AppleTouchIcon' => File::class,
        'Arrow' => File::class
    ];

    private static $has_many = [
        "FooterColumns" => FooterColumn::class,
    ];

    private static $owns = [
        'HeaderLogo',
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
        $fields->addFieldToTab("Root.Icons", new UploadField("HeaderLogo", "Header Logo"));
        $fields->addFieldToTab("Root.Icons", new UploadField("WhiteLogo", "Weißes Logo für dunkle Hintergründe"));
        $fields->addFieldToTab("Root.Icons", new UploadField("FooterLogo", "Footer Logo"));
        $fields->addFieldToTab("Root.Icons", new UploadField("Favicon", "Favicon"));
        $fields->addFieldToTab("Root.Icons", new UploadField("AppleTouchIcon", "Apple Touch Icon"));
        $fields->addFieldToTab("Root.Icons", new UploadField("SocialImage", "Social Image"));

        // LAYOUT Tab
        //Create a Layout Tab with Subtabs "General", "Header" and "Footer"
        $fields->addFieldToTab("Root.Layout", new TabSet("LayoutTabs",
            new Tab("General", "Allgemein"),
            new Tab("Header", "Header"),
            new Tab("Footer", "Footer")
        ));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.General", TextField::create("MaxWidth", "Maximale Breite")
            ->setDescription("Maximale Breite des Contents (z.B. 1200px, 100%, 1400px)")
            ->setAttribute('placeholder', '1200px'));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.General", TextField::create("MaxWidthContent", "Maximale Content-Breite")
            ->setDescription("Maximale Breite für Text-Content (z.B. 980px, 800px)")
            ->setAttribute('placeholder', '980px'));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.General", TextField::create("MaxWidthBlockText", "Maximale Block-Text-Breite")
            ->setDescription("Maximale Breite für Block-Text (z.B. 500px)")
            ->setAttribute('placeholder', '500px'));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.General", CheckboxField::create("ShowBreadcrumbs", "Breadcrumbs anzeigen"));

        $fields->addFieldToTab("Root.Layout.LayoutTabs.Header", DropdownField::create('HeaderVariant', 'Header Variante', [
            'Megamenu' => 'Megamenu',
            'SimpleNavBar' => 'Simple Navigations Leiste',
            'Sidebar' => 'Seitenleiste',
        ]));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.Header", DropdownField::create('LanguageToggleVariant', 'Sprachumschalter Variante', [
            'sharpdropdown' => 'Dropdown',
            'roundeddropdown' => 'Abgerundetes Dropdown',
            'flags' => 'Flaggen',
            'list' => 'Liste',
        ]));
        $fields->addFieldToTab("Root.Layout.LayoutTabs.Header", DropdownField::create('HeaderMenuAlignment', 'Header Menü Ausrichtung', [
            'flex-start' => 'Links',
            'center' => 'Zentriert',
            'flex-end' => 'Rechts',
        ]));

        // Footer Tab
        $footergridConfig = GridFieldConfig_RecordEditor::create();
        $footergridConfig->addComponent(new GridFieldOrderableRows('SortOrder'));
        $footergrid = GridField::create(
            "FooterColumns",
            "Footer Spalten",
            $this->owner->FooterColumns(),
            $footergridConfig
        );
        $fields->addFieldToTab("Root.Layout.LayoutTabs.Footer", $footergrid);
        $fields->addFieldToTab("Root.Layout.LayoutTabs.Footer", DropdownField::create('FooterMenuAlignment', 'Footer Menü Ausrichtung', [
            'flex-start' => 'Links',
            'center' => 'Zentriert',
            'flex-end' => 'Rechts',
        ]));

        // Styling Tab
        $fields->addFieldToTab("Root.Styling", new TabSet("StylingTabs",
            new Tab("Primary", "Primärfarben"),
            new Tab("Secondary", "Sekundärfarben"),
            new Tab("Text", "Textfarben"),
            new Tab("Other", "Sonstiges"),
        ));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Primary", TextField::create("ColorPrimary", "Primärfarbe")
            ->setDescription("Hauptfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Primary", TextField::create("ColorPrimaryLight", "Helle Primärfarbe")
            ->setDescription("Helle Primärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Primary", TextField::create("ColorPrimaryDark", "Dunkle Primärfarbe")
            ->setDescription("Dunkle Primärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Primary", CheckboxField::create("ColorPrimaryFontWhite", "Weiße Schrift auf Primärfarbe")
            ->setDescription("Überschreibt die Textfarben mit weiß, wenn sie auf der Primärfarbe liegen"));

        $fields->addFieldToTab("Root.Styling.StylingTabs.Secondary", TextField::create("ColorSecondary", "Sekundärfarbe")
            ->setDescription("Sekundärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Secondary", TextField::create("ColorSecondaryLight", "Helle Sekundärfarbe")
            ->setDescription("Helle Sekundärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Secondary", TextField::create("ColorSecondaryDark", "Dunkle Sekundärfarbe")
            ->setDescription("Dunkle Sekundärfarbe der Website")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Secondary", CheckboxField::create("ColorSecondaryFontWhite", "Weiße Schrift auf Sekundärfarbe")
            ->setDescription("Überschreibt die Textfarben mit weiß, wenn sie auf der Sekundärfarbe liegen"));

        $fields->addFieldToTab("Root.Styling.StylingTabs.Text", TextField::create("ColorHeadline", "Überschriftfarbe")
            ->setDescription("Farbe der Überschriften")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Text", TextField::create("ColorText", "Textfarbe")
            ->setDescription("Farbe des Fließtextes")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Other", TextField::create("ColorBackground", "Hintergrundfarbe")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Other", TextField::create("ColorMenuBackground", "Hintergrundfarbe Navigation")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Other", TextField::create("ColorMenuText", "Textfarbe Navigation")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Other", TextField::create("ColorMenuTextHover", "Textfarbe Navigation Hover")
            ->setAttribute('type', 'color'));
        $fields->addFieldToTab("Root.Styling.StylingTabs.Other", UploadField::create("Arrow", "Pfeil nach rechts")
            ->setDescription("Ein Pfeil zur Navigation in Slidern"));

        // Fonts Tab
        $fields->addFieldToTab("Root.Schriften.Header", DropdownField::create('HeaderFont', 'Header Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
            'Sansation' => 'Sansation',
        ]));
        $fields->addFieldToTab("Root.Schriften.Body", DropdownField::create('BodyFont', 'Body Font', [
            'Roboto' => 'Roboto',
            'DM Sans' => 'DM Sans',
            'Open Sans' => 'Open Sans',
            'Sansation' => 'Sansation',
        ]));

        //Add Version number of the SCK module in a new tab
        $fields->addFieldToTab("Root.ProjectInfo", new ReadonlyField("SCKVersion", "SCK Version", $this->getSCKVersion()));

        // Custom Tab
        $fields->addFieldToTab("Root.Custom", new TextareaField("CustomCSS", "Custom CSS"));
    }

    /**
     * Get the version of the SCK module from composer.json
     */
    public function getSCKVersion()
    {
        $module = ModuleLoader::inst()->getManifest()->getModule('atwx/sck');
        if ($module) {
            $composerPath = $module->getPath() . '/composer.json';
            if (file_exists($composerPath)) {
                $composerData = json_decode(file_get_contents($composerPath), true);
                return $composerData['version'] ?? 'Unknown';
            }
        }
        return 'Unknown';
    }

    public function getMaxWidthValue()
    {
        return $this->owner->MaxWidth ?: '1200px';
    }

    public function getMaxWidthContentValue()
    {
        return $this->owner->MaxWidthContent ?: '980px';
    }

    public function getMaxWidthBlockTextValue()
    {
        return $this->owner->MaxWidthBlockText ?: '500px';
    }

    public function getColorPrimaryValue()
    {
        return $this->owner->ColorPrimary ?: '#03395E';
    }

    public function getColorPrimaryDarkValue()
    {
        return $this->owner->ColorPrimaryDark ?: '#022E4D';
    }

    public function getColorPrimaryLightValue()
    {
        return $this->owner->ColorPrimaryLight ?: '#055A81';
    }

    public function getColorSecondaryValue()
    {
        return $this->owner->ColorSecondary ?: '#63819C';
    }

    public function getColorSecondaryDarkValue()
    {
        return $this->owner->ColorSecondaryDark ?: '#4A6273';
    }

    public function getColorSecondaryLightValue()
    {
        return $this->owner->ColorSecondaryLight ?: '#7D9ABF';
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
