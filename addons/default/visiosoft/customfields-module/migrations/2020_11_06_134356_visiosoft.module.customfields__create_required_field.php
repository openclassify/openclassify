<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsCreateRequiredField extends Migration
{
    protected $delete = false;

    protected $stream = [
        'slug' => 'custom_fields',
    ];

    protected $fields = [
        'required' => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "mode" => "checkbox",
            ]
        ],
    ];

    protected $assignments = [
        'required',
    ];
}
