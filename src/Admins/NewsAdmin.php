<?php

namespace Atwx\Sck\Admins;

use Atwx\Sck\News\NewsCategory;
use Atwx\Sck\News\NewsEntry;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class \App\Admins\EventAdmin
 *
 */
class NewsAdmin extends ModelAdmin
{
    private static $menu_title = 'News';

    private static $url_segment = 'news';
    private static $menu_icon_class = 'font-icon-news';

    private static $managed_models = [
        NewsEntry::class,
        NewsCategory::class
    ];
}
