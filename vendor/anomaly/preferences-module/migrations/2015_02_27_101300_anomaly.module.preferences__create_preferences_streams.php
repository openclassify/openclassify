<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePreferencesCreatePreferencesStreams
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePreferencesCreatePreferencesStreams extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'preferences',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'user' => [
            'required' => true,
        ],
        'key'  => [
            'required' => true,
        ],
        'value',
    ];

}
