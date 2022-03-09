<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class SettingConfiguration
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingConfiguration
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new SettingConfiguration instance.
     *
     * @param SettingRepositoryInterface $settings
     * @param Evaluator $evaluator
     */
    public function __construct(SettingRepositoryInterface $settings, Evaluator $evaluator)
    {
        $this->settings  = $settings;
        $this->evaluator = $evaluator;
    }

    /**
     * Return configuration within an addon's settings.
     *
     * @param Addon $addon
     * @return array
     */
    public function read(Addon $addon)
    {
        $config = [];

        $settings = array_merge(
            config($addon->getNamespace('settings'), []),
            config($addon->getNamespace('settings/settings'), [])
        );

        foreach ($settings as $key => $setting) {

            /**
             * If the setting has a value in .env representing
             * this setting then skip it since it's already set.
             */
            if (isset($setting['env']) && env($setting['env']) !== null) {
                continue;
            }

            /**
             * If no configuration is bound to the then there
             * setting then there is no need to do anything here.
             */
            if (!isset($setting['bind'])) {
                continue;
            }

            $default = array_get($setting, 'config.default_value');

            if (!$this->settings->has($key = $addon->getNamespace($key)) && !$default) {
                continue;
            }

            if ($presenter = $this->settings->presenter($key)) {

                $config[$setting['bind']] = $presenter->__value();

                continue;
            }

            $config[$setting['bind']] = $this->evaluator->evaluate($default);
        }

        return $config;
    }

    /**
     * Return configuration from Streams settings.
     *
     * @return array
     */
    public function system()
    {
        $config = [];

        $settings = config('streams::settings/settings', []);

        foreach ($settings as $key => $setting) {

            /**
             * If the setting has a value in .env representing
             * this setting then skip it since it's already set.
             */
            if (isset($setting['env']) && env($setting['env']) !== null) {
                continue;
            }

            /**
             * If no configuration is bound to the then there
             * setting then there is no need to do anything here.
             */
            if (!isset($setting['bind'])) {
                continue;
            }

            $default = array_get($setting, 'config.default_value');

            if (!$this->settings->has($key = 'streams::' . $key) && !$default) {
                continue;
            }

            if ($presenter = $this->settings->presenter($key)) {

                $config[$setting['bind']] = $presenter->__value();

                continue;
            }

            $config[$setting['bind']] = $this->evaluator->evaluate($default);
        }

        return $config;
    }
}
