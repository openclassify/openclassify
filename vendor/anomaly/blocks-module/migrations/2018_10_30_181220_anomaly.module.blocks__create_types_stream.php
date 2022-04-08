<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksCreateTypesStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksCreateTypesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'types',
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
        'category'       => [
            'required' => true,
        ],
        'name'           => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
        ],
        'slug'           => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_',
            ],
        ],
        'description'    => [
            'translatable' => true,
        ],
        'content_layout' => [
            'required' => true,
        ],
        'wrapper_layout' => [
            'required' => true,
        ],
    ];

}
