<?php namespace Anomaly\PreferencesModule;

use Anomaly\PreferencesModule\Preference\Command\GetPreference;
use Anomaly\PreferencesModule\Preference\Command\GetPreferenceValue;
use Anomaly\PreferencesModule\Preference\Command\GetValueFieldType;
use Anomaly\PreferencesModule\Preference\Contract\PreferenceInterface;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class PreferencesModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PreferencesModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'preference_value',
                function ($key, $default = null) {
                    return $this->dispatch(new GetPreferenceValue($key, $default));
                }
            ),
            new \Twig_SimpleFunction(
                'preference',
                function ($key) {

                    /* @var PreferenceInterface $preference */
                    if (!$preference = $this->dispatch(new GetPreference($key))) {
                        return null;
                    }

                    return (new Decorator())->decorate($this->dispatch(new GetValueFieldType($preference)));
                }
            ),
        ];
    }
}
