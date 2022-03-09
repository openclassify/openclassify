<?php namespace Anomaly\Streams\Platform\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class DefaultLocaleHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DefaultLocaleHandler
{

    /**
     * Handle the command.
     *
     * @param SelectFieldType $fieldType
     */
    public function handle(SelectFieldType $fieldType)
    {
        $fieldType->setOptions(
            array_combine(
                $keys = array_keys(config('streams::locales.supported')),
                array_map(
                    function ($locale) {
                        return trans('streams::locale.' . $locale . '.name') . ' (' . $locale . ')';
                    },
                    $keys
                )
            )
        );
    }
}
