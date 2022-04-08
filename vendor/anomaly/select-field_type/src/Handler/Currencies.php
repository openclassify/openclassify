<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class Currencies
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class Currencies
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository      $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $currencies = array_values($config->get('streams::currencies.enabled'));

        $fieldType->setOptions(
            array_combine(
                $currencies,
                $currencies
            )
        );
    }
}
