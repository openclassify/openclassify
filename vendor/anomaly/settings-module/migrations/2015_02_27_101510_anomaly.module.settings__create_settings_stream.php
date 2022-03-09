<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleSettingsCreateSettingsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleSettingsCreateSettingsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'settings',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'key' => [
            'required' => true,
            'unique'   => true,
        ],
        'value',
    ];

}
