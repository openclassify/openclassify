<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddCustomOptionValue extends Migration
{
    protected $stream = [
        'slug' => 'option_configuration',
    ];

    protected $fields = [
        'custom_option' => [
            'type' => 'anomaly.field_type.text',
        ],
    ];

    protected $assignments = [
        'custom_option'
    ];
}
