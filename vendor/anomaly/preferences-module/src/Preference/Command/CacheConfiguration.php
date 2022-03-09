<?php namespace Anomaly\PreferencesModule\Preference\Command;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\PreferencesModule\Preference\PreferenceConfiguration;
use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class CacheConfiguration
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheConfiguration
{

    /**
     * Handle the command.
     */
    public function handle()
    {
        $preferences   = app(PreferenceRepositoryInterface::class);
        $configuration = app(PreferenceConfiguration::class);
        $addons        = app(AddonCollection::class);

        $preferences->cacheForever(
            'anomaly.module.preferences::preferences.config',
            function () use ($addons, $configuration) {

                $config = [];

                foreach ($addons->withConfig('preferences') as $namespace => $addon) {
                    $config = array_merge($config, $configuration->read($addon));
                }

                foreach ($addons->withConfig('preferences/preferences') as $namespace => $addon) {
                    $config = array_merge($config, $configuration->read($addon));
                }

                $config = array_merge($config, $configuration->system());

                return $config;
            }
        );
    }
}
