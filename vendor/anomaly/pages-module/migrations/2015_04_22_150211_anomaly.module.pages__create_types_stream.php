<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePagesCreateTypesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesCreateTypesStream extends Migration
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
        'name'         => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
            'config'       => [
                'max' => 26,
            ],
        ],
        'slug'         => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_',
                'max'     => 26,
            ],
        ],
        'description'  => [
            'translatable' => true,
        ],
        'theme_layout' => [
            'required' => true,
        ],
        'layout'       => [
            'required' => true,
        ],
        'handler'      => [
            'required' => true,
        ],
    ];

}
