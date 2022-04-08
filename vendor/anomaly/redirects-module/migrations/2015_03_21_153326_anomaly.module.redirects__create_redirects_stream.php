<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleRedirectsCreateRedirectsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleRedirectsCreateRedirectsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var string
     */
    protected $stream = [
        'slug'         => 'redirects',
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
        'to'     => [
            'required' => true,
        ],
        'status' => [
            'required' => true,
        ],
        'secure',
    ];

}
