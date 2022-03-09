<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsAddMetadataFieldsToTypes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsAddMetadataFieldsToTypes extends Migration
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
        'slug' => 'types',
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
