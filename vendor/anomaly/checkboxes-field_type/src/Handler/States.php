<?php namespace Anomaly\CheckboxesFieldType\Handler;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class States
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CheckboxesFieldType\Handler
 */
class States
{

    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     * @param Repository          $config
     */
    public function handle(CheckboxesFieldType $fieldType, Repository $config)
    {
        $options = [];

        $countries = (array)$fieldType->config('countries', 'US');

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
