<?php

namespace Atwx\Sck\Controller;

use SilverStripe\Control\Controller;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\TemplateGlobalProvider;

class CustomCssController extends Controller implements TemplateGlobalProvider
{

    public function index()
    {
        $this->getResponse()->addHeader('Content-Type', 'text/css');
        return [];
    }

    public static function get_template_global_variables(): array
    {
        return [
            'CustomCssURL',
        ];
    }

    public static function CustomCssURL(): string
    {
        $siteConfig = SiteConfig::current_site_config();
        $lastEdited = $siteConfig->LastEdited;
        return '_sck/custom.css?v=' . strtotime($lastEdited);
    }
}
