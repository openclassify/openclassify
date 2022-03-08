<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleNotificationsCreateTemplateEnabledField extends Migration
{
    protected $delete = false;

    protected $stream = [
        'slug' => 'template',
    ];

    protected $fields = [
        'enabled' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
    ];

    protected $assignments = [
        'enabled',
    ];
}
