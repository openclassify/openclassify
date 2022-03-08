<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleNotificationsCreateNotifyStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'notify',
        'title_column' => 'subdomain',
        'translatable' => false,
        'versionable' => false,
        'trashable' => false,
        'searchable' => false,
        'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'subdomain' => [
            'unique' => true,
            'required' => true,
        ],
        'remaining_days' => [
            'required' => true,
        ],
    ];

}
