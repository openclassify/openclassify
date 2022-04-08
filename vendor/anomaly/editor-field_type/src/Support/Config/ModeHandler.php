<?php namespace Anomaly\EditorFieldType\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ModeHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModeHandler
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $fieldType->setOptions(
            array_combine(
                array_keys($config->get('anomaly.field_type.editor::editor.modes')),
                array_map(
                    function ($mode) {
                        return $mode['name'];
                    },
                    $config->get('anomaly.field_type.editor::editor.modes')
                )
            )
        );
    }
}
