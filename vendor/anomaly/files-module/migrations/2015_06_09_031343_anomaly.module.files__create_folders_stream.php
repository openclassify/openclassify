<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFilesCreateFoldersStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesCreateFoldersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'folders',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'disk'        => [
            'required' => true,
        ],
        'name'        => [
            'required'     => true,
            'translatable' => true,
            'config'       => [
                'max' => 50,
            ],
        ],
        'slug'        => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'max' => 50,
            ],
        ],
        'description' => [
            'translatable' => true,
        ],
        'allowed_types',
    ];

}
