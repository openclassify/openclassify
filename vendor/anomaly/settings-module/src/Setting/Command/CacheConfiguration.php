<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\SettingConfiguration;
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
     *
     * @param SettingRepositoryInterface $settings
     * @param SettingConfiguration $configuration
     * @param AddonCollection $addons
     */
    public function handle(
        SettingRepositoryInterface $settings,
        SettingConfiguration $configuration,
        AddonCollection $addons
    ) {
        $settings->cacheForever(
            'anomaly.module.settings::settings.config',
            function () use ($addons, $configuration) {

                $config = [];

                foreach ($addons->withConfig('settings') as $namespace => $addon) {
                    $config = array_merge($config, $configuration->read($addon));
                }

                foreach ($addons->withConfig('settings/settings') as $namespace => $addon) {
                    $config = array_merge($config, $configuration->read($addon));
                }

                $config = array_merge($config, $configuration->system());

                return $config;
            }
        );
    }
}
