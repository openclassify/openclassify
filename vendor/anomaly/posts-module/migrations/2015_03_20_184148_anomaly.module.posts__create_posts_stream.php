<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsCreatePostsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsCreatePostsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'posts',
        'title_column' => 'title',
        'translatable' => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'           => [
            'required' => true,
            'unique'   => true,
        ],
        'title'            => [
            'translatable' => true,
            'required'     => true,
        ],
        'summary'          => [
            'translatable' => true,
        ],
        'slug'             => [
            'required' => true,
            'unique'   => true,
        ],
        'type'             => [
            'required' => true,
        ],
        'publish_at'       => [
            'required' => true,
        ],
        'author'           => [
            'required' => true,
        ],
        'entry'            => [
            'required' => true,
        ],
        'meta_title'       => [
            'translatable' => true,
        ],
        'meta_description' => [
            'translatable' => true,
        ],
        'category',
        'featured',
        'enabled',
        'tags',
    ];

}
