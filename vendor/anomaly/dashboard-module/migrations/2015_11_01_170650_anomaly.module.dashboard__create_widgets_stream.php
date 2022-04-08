<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleDashboardCreateWidgetsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDashboardCreateWidgetsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'widgets',
        'title_column' => 'title',
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
        'title'       => [
            'required'     => true,
            'translatable' => true,
        ],
        'description' => [
            'translatable' => true,
        ],
        'extension'   => [
            'required' => true,
        ],
        'column'      => [
            'required' => true,
        ],
        'dashboard'   => [
            'required' => true,
        ],
        'allowed_roles',
        'pinned',
    ];

}
