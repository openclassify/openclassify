<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleNotificationsAddedTemplateView extends Migration
{
    protected $stream = [
        'slug' => 'template',
    ];

    protected $fields = [
        'view' => [
            'type' => 'anomaly.field_type.text',
            'config' => [
                'default_value' => null,
            ],
        ],
    ];

    protected $assignments = [
        'view',
    ];
}
