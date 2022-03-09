<?php namespace Anomaly\PreferencesModule\Preference\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class ConfigureSystem
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureSystem
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param AddonCollection $addons
     * @param Evaluator $evaluator
     */
    public function handle()
    {
        config(cache('anomaly.module.preferences::preferences.config', []));
    }
}
