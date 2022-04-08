<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleRedirectsCreateDomainsStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleRedirectsCreateDomainsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var string
     */
    protected $stream = [
        'slug'         => 'domains',
        'title_column' => 'from',
        'sortable'     => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'from'   => [
            'unique'   => true,
            'required' => true,
        ],
        'to',
        'status' => [
            'required' => true,
        ],
        'secure',
    ];

}
