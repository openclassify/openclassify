<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsAddMetadataFieldsToCategories
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsAddMetadataFieldsToCategories extends Migration
{

    /**
     * The stream defined is
     * only for identification.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The stream we're working with.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'categories',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'meta_title'       => [
            'translatable' => true,
        ],
        'meta_description' => [
            'translatable' => true,
        ],
    ];
}
