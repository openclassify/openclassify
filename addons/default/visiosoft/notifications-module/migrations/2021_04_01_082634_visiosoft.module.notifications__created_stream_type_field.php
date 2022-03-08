<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleNotificationsCreatedStreamTypeField extends Migration
{
    protected $stream = [
        'slug' => 'template',
    ];

    protected $fields = [
        'stream' => [
            'type' => 'anomaly.field_type.text',
            'config' => [
                'default_value' => null,
            ],
        ],
    ];

    protected $assignments = [
        'stream',
    ];
}
