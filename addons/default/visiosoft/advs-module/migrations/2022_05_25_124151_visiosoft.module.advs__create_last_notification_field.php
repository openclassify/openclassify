<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateLastNotificationField extends Migration
{

    protected $stream = [
        'slug' => 'advs',
        'title_column' => 'notificated_at',
    ];

    protected $fields = [
        'notificated_at' => [
            'type' => 'anomaly.field_type.datetime',
            'config' => [
                'required' => false,
            ]
        ],
    ];

    protected $assignments = [
        'notificated_at'
    ];

}
