<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsCreateTypesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsCreateTypesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'types',
        'title_column' => 'name',
        'sortable'     => true,
        'translatable' => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'         => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
            'config'       => [
                'max' => 50,
            ],
        ],
        'slug'         => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_',
                'max'     => 50,
            ],
        ],
        'layout'       => [
            'required' => true,
        ],
        'theme_layout' => [
            'required' => true,
        ],
        'description'  => [
            'translatable' => true,
        ],
    ];

}
