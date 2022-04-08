<?php

use Anomaly\BlocksModule\Type\TypeModel;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksAddTypeToBlocks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksAddTypeToBlocks extends Migration
{

    /**
     * Don't delete the stream here
     * it's only for reference use.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'type' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => TypeModel::class,
            ],
        ],
    ];

    /**
     * The addon stream.
     * This is only for
     * reference for below.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'blocks',
    ];

    /**
     * The addon assignments.
     *
     * @var array
     */
    protected $assignments = [
        'type',
    ];

}
