<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateStatusStream extends Migration
{
    protected $delete = true;

    protected $stream = [
        'slug' => 'status',
        'title_column' => 'slug',
        'translatable' => true,
        'versionable' => false,
        'trashable' => true,
        'searchable' => false,
        'sortable' => false,
    ];

    protected $fields = [
        "is_system" => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "mode"          => "radio",
            ]
        ],
        "user_access" => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => true,
                "mode"          => "radio",
            ]
        ]
    ];

    protected $assignments = [
        'name' => [
            'required' => true,
            'translatable' => true,
        ],
        'slug' => [
            'required' => true,
            'unique' => true,
        ],
        "is_system",
        "user_access"
    ];
}
