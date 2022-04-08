<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksAddDisplayTitleFieldToBlocks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksAddDisplayTitleFieldToBlocks extends Migration
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
        'display_title' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
                'mode'          => 'checkbox',
                'label'         => 'anomaly.module.blocks::field.display_title.label',
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
        'display_title',
    ];

}
