<?php namespace Anomaly\StateFieldType\Handler;

use Anomaly\StateFieldType\StateFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class DefaultHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DefaultHandler
{

    /**
     * Handle the options.
     *
     * @param StateFieldType $fieldType
     * @param Repository     $config
     */
    public function handle(StateFieldType $fieldType, Repository $config)
    {
        $options = [];

        if (!$countries = $fieldType->config('countries')) {
            $countries = array_keys($config->get('streams::countries.available'));
        }

        foreach ($countries as $code) {

            $country = $config->get('streams::countries.available.' . $code);

            if ($states = $config->get('streams::states/' . $code . '.available')) {

                $options[$country['name']] = array_combine(
                    array_keys($states),
                    array_map(
                        function ($state) {
                            return trans($state['name']);
                        },
                        $states
                    )
                );
            }
        }

        sort($options);

        $fieldType->setOptions($options);
    }
}
