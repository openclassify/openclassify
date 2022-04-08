<?php namespace Anomaly\Streams\Platform\Application;

use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class ApplicationModel
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ApplicationModel extends EloquentModel
{

    /**
     * No timestamps right now.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The connection to use.
     *
     * @var string
     */
    protected $connection = 'core';

    /**
     * The model table.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'enabled',
        'reference',
    ];

    /**
     * The attribute castings.
     *
     * @var array
     */
    protected $casts = [
        'enabled'   => 'boolean',
        'installed' => 'boolean',
    ];
}
