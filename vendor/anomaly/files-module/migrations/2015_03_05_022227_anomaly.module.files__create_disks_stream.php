<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFilesCreateDisksStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesCreateDisksStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'disks',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'        => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
        ],
        'slug'        => [
            'required' => true,
            'unique'   => true,
        ],
        'adapter'     => [
            'required' => true,
        ],
        'description' => [
            'translatable' => true,
        ],
    ];

}
