<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class States
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class States
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository      $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $options = [];

        $countries = $fieldType->config('countries', ['US']);

        foreach ($countries as $code) {

            $country = $config->get('streams::countries.' . $code . '.available');

            if ($states = $config->get('streams::states/' . $code . '.available')) {
                $options[$country['name']] = array_combine(
                    array_keys($states),
                    array_map(
                        function ($state) {
                            return $state['name'];
                        },
                        $states
                    )
                );
            }
        }

        if (count($options) == 1) {
            $options = array_pop($options);
        }

        $fieldType->setOptions($options);
    }
}
