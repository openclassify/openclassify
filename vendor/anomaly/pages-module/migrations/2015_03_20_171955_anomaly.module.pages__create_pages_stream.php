<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePagesCreatePagesStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesCreatePagesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'pages',
        'title_column' => 'title',
        'translatable' => true,
        'searchable'   => true,
        'trashable'    => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'           => [
            'required' => true,
        ],
        'title'            => [
            'translatable' => true,
            'required'     => true,
        ],
        'slug'             => [
            'required' => true,
        ],
        'path'             => [
            'required' => true,
        ],
        'type'             => [
            'required' => true,
        ],
        'ttl',
        'entry',
        'parent',
        'visible',
        'enabled',
        'exact',
        'home',
        'status',
        'meta_title'       => [
            'translatable' => true,
        ],
        'meta_description' => [
            'translatable' => true,
        ],
        'meta_keywords'    => [
            'translatable' => true,
        ],
        'theme_layout',
        'allowed_roles',
    ];
}
