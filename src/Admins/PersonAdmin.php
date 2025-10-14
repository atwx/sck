<?php

namespace Atwx\Sck\Admins;

use Atwx\Sck\People\Person;
use Atwx\Sck\People\PersonGroup;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class \App\Admins\EventAdmin
 *
 */
class PersonAdmin extends ModelAdmin
{
    private static $menu_title = 'Personen';

    private static $url_segment = 'people';
    private static $menu_icon_class = 'font-icon-torso';

    private static $managed_models = [
        Person::class,
        PersonGroup::class
    ];
}
