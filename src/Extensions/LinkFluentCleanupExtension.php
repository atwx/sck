<?php

namespace App\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * Entfernt Fluent-spezifische Felder aus dem LinkField-Formular
 * (da es kein React-UI für RecordLocales hat).
 */
class LinkFluentCleanupExtension extends Extension
{
    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName('RecordLocales');
    }
}
