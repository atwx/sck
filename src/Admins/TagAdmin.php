<?php

namespace Atwx\Sck\Admins;

use Atwx\Sck\Tags\Tag;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_Base;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton;
use Atwx\Sck\Controllers\TagAdminController;
use Colymba\BulkManager\BulkManager;

/**
 * Class \App\Admins\EventAdmin
 *
 */
class TagAdmin extends ModelAdmin
{
    private static $menu_title = 'Tags';

    private static $url_segment = 'tags';
    private static $menu_icon_class = 'font-icon-tags';

    private static $managed_models = [
        Tag::class,
    ];

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        // Get the gridfield for the managed model
        $gridField = $form->Fields()->fieldByName($this->sanitiseClassName(Tag::class));
        if ($gridField) {
            $config = $gridField->getConfig();
            $config->addComponent(new BulkManager());
        }

        return $form;
    }
}
