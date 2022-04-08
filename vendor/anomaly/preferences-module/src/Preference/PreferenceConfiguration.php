<?php namespace Anomaly\PreferencesModule\Preference;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class PreferenceConfiguration
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PreferenceConfiguration
{

    /**
     * The preferences repository.
     *
     * @var PreferenceRepositoryInterface
     */
    protected $preferences;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new PreferenceConfiguration instance.
     *
     * @param PreferenceRepositoryInterface $preferences
     * @param Evaluator $evaluator
     */
    public function __construct(PreferenceRepositoryInterface $preferences, Evaluator $evaluator)
    {
        $this->preferences = $preferences;
        $this->evaluator   = $evaluator;
    }

    /**
     * Return configuration within an addon's preferences.
     *
     * @param Addon $addon
     * @return array
     */
    public function read(Addon $addon)
    {
        $config = [];

        $preferences = array_merge(
            config($addon->getNamespace('preferences'), []),
            config($addon->getNamespace('preferences/preferences'), [])
        );

        foreach ($preferences as $key => $preference) {

            /**
             * If the preference has a value in .env representing
             * this preference then skip it since it's already set.
             */
            if (isset($preference['env']) && env($preference['env']) !== null) {
                continue;
            }

            /**
             * If no configuration is bound to the then there
             * preference then there is no need to do anything here.
             */
            if (!isset($preference['bind'])) {
                continue;
            }

            $default = array_get($preference, 'config.default_value');

            if (!$this->preferences->has($key = $addon->getNamespace($key)) && !$default) {
                continue;
            }

            if ($presenter = $this->preferences->presenter($key)) {

                $config[$preference['bind']] = $presenter->__value();

                continue;
            }

            $config[$preference['bind']] = $this->evaluator->evaluate($default);
        }

        return $config;
    }

    /**
     * Return configuration from Streams preferences.
     *
     * @return array
     */
    public function system()
    {
        $config = [];

        $preferences = config('streams::preferences/preferences', []);

        foreach ($preferences as $key => $preference) {

            /**
             * If the preference has a value in .env representing
             * this preference then skip it since it's already set.
             */
            if (isset($preference['env']) && env($preference['env']) !== null) {
                continue;
            }

            /**
             * If no configuration is bound to the then there
             * preference then there is no need to do anything here.
             */
            if (!isset($preference['bind'])) {
                continue;
            }

            $default = array_get($preference, 'config.default_value');

            if (!$this->preferences->has($key = 'streams::' . $key) && !$default) {
                continue;
            }

            if ($presenter = $this->preferences->presenter($key)) {

                $config[$preference['bind']] = $presenter->__value();

                continue;
            }

            $config[$preference['bind']] = $this->evaluator->evaluate($default);
        }

        return $config;
    }
}
