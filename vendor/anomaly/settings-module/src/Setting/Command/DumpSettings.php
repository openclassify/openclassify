<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Config\Command\CacheConfig;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class DumpSettings
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DumpSettings
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param AddonCollection $addons
     * @param Evaluator $evaluator
     */
    public function handle(SettingRepositoryInterface $settings, AddonCollection $addons, Evaluator $evaluator)
    {
        $file = app_storage_path('settings/config.php');

        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        $configuration = [];

        $settings->load();

        /* @var Addon $addon */
        foreach ($addons->withConfig('settings') as $addon) {

            foreach (config($addon->getNamespace('settings')) as $key => $setting) {

                if (isset($setting['env']) && env($setting['env']) !== null) {
                    continue;
                }

                if (!isset($setting['bind'])) {
                    continue;
                }

                $default = array_get($setting, 'config.default_value');

                if (!$settings->has($key = $addon->getNamespace($key)) && !$default) {
                    continue;
                }

                if ($presenter = $settings->presenter($key)) {

                    $configuration[$setting['bind']] = $presenter->__value();

                    continue;
                }

                $configuration[$setting['bind']] = $evaluator->evaluate($default);
            }
        }

        /* @var Addon $addon */
        foreach ($addons->withConfig('settings/settings') as $addon) {

            foreach (config($addon->getNamespace('settings/settings')) as $key => $setting) {

                if (isset($setting['env']) && env($setting['env']) !== null) {
                    continue;
                }

                if (!isset($setting['bind'])) {
                    continue;
                }

                $default = array_get($setting, 'config.default_value');

                if (!$settings->has($key = $addon->getNamespace($key)) && !$default) {
                    continue;
                }

                if ($presenter = $settings->presenter($key)) {

                    $configuration[$setting['bind']] = $presenter->__value();

                    continue;
                }

                $configuration[$setting['bind']] = $evaluator->evaluate($default);
            }
        }

        foreach (config('streams::settings/settings', []) as $key => $setting) {

            if (isset($setting['env']) && env($setting['env']) !== null) {
                continue;
            }

            if (!isset($setting['bind'])) {
                continue;
            }

            $default = array_get($setting, 'config.default_value');

            if (!$settings->has($key = 'streams::' . $key) && !$default) {
                continue;
            }

            if ($presenter = $settings->presenter($key)) {

                $configuration[$setting['bind']] = $presenter->__value();

                continue;
            }

            $configuration[$setting['bind']] = $evaluator->evaluate($default);
        }

        file_put_contents($file, "<?php\n\n return " . var_export($configuration, true) . ";");

        dispatch_now(new CacheConfig());
    }
}
