<?php

namespace Atwx\Sck\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use TractorCow\Fluent\Model\RecordLocale;

/**
 * Provides the flag of a locale for the language switcher.
 *
 * The flag is derived from the region part of the locale (de_DE => de,
 * fr_FR => fr, da_DK => dk). Flags can be overridden per locale or per
 * language via the flag_overrides config, e.g. to show the British flag
 * for en_US.
 *
 * @property RecordLocale $owner
 */
class RecordLocaleFlagExtension extends Extension
{
    /**
     * Map of locale ("en_US") or language ("en") to flag-icons country code.
     */
    private static array $flag_overrides = [
        'en' => 'gb',
    ];

    public function getFlagCode(): string
    {
        $locale = (string) $this->owner->getLocale();
        $overrides = Config::inst()->get(static::class, 'flag_overrides') ?: [];

        if (isset($overrides[$locale])) {
            return $overrides[$locale];
        }

        $parts = explode('_', $locale);
        $language = strtolower($parts[0]);
        if (isset($overrides[$language])) {
            return $overrides[$language];
        }

        return strtolower(count($parts) > 1 ? end($parts) : $language);
    }

    public function getFlagURL(): ?string
    {
        return ModuleResourceLoader::resourceURL(
            sprintf('atwx/sck:client/flags/%s.svg', $this->getFlagCode())
        );
    }
}
