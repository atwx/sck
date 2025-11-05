<?php

namespace Atwx\Sck\Admins;

use Atwx\Sck\Events\Event;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class \App\Admins\EventAdmin
 *
 */
class EventAdmin extends ModelAdmin
{
    private static $menu_title = 'Termine';

    private static $url_segment = 'events';
    private static $menu_icon_class = 'font-icon-calendar';

    private static $managed_models = [
        Event::class
    ];
}
