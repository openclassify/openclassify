<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksCreateBlocksStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksCreateBlocksStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'blocks',
        'title_column' => 'type',
        'translatable' => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title'     => [
            'translatable' => true,
        ],
        'area'      => [
            'required' => true,
        ],
        'field'     => [
            'required' => true,
        ],
        'extension' => [
            'required' => true,
        ],
        'entry',
    ];

}
