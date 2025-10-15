<?php

namespace App\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\Extension;
use SilverStripe\Versioned\Versioned;
use TractorCow\Fluent\Extension\FluentExtension;
use TractorCow\Fluent\Model\Locale;
use TractorCow\Fluent\State\FluentState;

/**
 * Class \App\Extensions\FluentArchiveAllLocales
 *
 * @property BaseElement|\App\Extensions\FluentArchiveAllLocales $owner
 */
class FluentArchiveAllLocales extends Extension
{
    public function onAfterArchive()
    {
        $this->syncOtherLocales('doArchive');
    }

    public function onAfterUnpublish()
    {
        $this->syncOtherLocales('doUnpublish');
    }

    public function onAfterDelete()
    {
        $this->syncOtherLocales('delete');
    }

    private function syncOtherLocales(string $action): void
    {
        $owner = $this->getOwner();
        if (!$owner->hasExtension(Versioned::class)) {
            return;
        }
        if (!$owner->hasExtension(FluentExtension::class)) {
            return;
        }

        $defaultLocale = Locale::singleton()->getDefaultLocale();
        if ($owner->Locale !== $defaultLocale) {
            return;
        }

        //get all translations of this object
        $allTranslations = $owner->Locales();

        foreach ($allTranslations as $locale) {
            if ($locale->getLocale() === $defaultLocale) {
                continue;
            }
            //archive the translation
            FluentState::singleton()->withState(function (FluentState $state) use ($locale, $owner, $action) {
                $state->setLocale($locale->getLocale());
                $translatedItem = $owner::get()->byID($owner->ID);

                if (!$translatedItem) {
                    return;
                }

                $translatedItem->$action();
            });
        }
    }
}
