<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsCreateCategoriesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsCreateCategoriesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'categories',
        'title_column' => 'name',
        'translatable' => true,
        'sortable'     => true,
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
            'config'   => [
                'slugify' => 'name',
            ],
        ],
        'description' => [
            'translatable' => true,
        ],
    ];

}
