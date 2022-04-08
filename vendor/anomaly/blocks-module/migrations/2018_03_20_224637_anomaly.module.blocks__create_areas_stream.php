<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksCreateAreasStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksCreateAreasStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'areas',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => false,
        'searchable'   => false,
        'sortable'     => false,
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
        ],
        'slug'        => [
            'unique'   => true,
            'required' => true,
        ],
        'description' => [
            'translatable' => true,
        ],
        'blocks',
    ];

}
