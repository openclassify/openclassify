<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsAddHideAddetailColumn extends Migration
{
    protected $stream = [
        'slug' => 'custom_fields',
    ];

    protected $fields = [
        "hide_addetail" => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ]
    ];

    protected $assignments = [
        'hide_addetail'
    ];
}
