<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsAddShowFilterColumn extends Migration
{
    protected $stream = [
        'slug' => 'custom_fields',
    ];

    protected $fields = [
        "show_filter" => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 1,
            ]
        ]
    ];

    protected $assignments = [
        'show_filter'
    ];
}
