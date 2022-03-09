<?php namespace Anomaly\WysiwygFieldType\Support\Config;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class PluginsHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PluginsHandler
{

    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     * @param Repository $config
     */
    public function handle(CheckboxesFieldType $fieldType, Repository $config)
    {
        $keys = array_keys($config->get('anomaly.field_type.wysiwyg::redactor.plugins'));

        $values = array_map(
            function ($value) {
                return trans('anomaly.field_type.wysiwyg::redactor.plugin.' . $value);
            },
            $keys
        );

        $fieldType->setOptions(array_combine($keys, $values));
    }
}
