<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateUserStatusField extends Migration
{
    protected $delete = false;

    protected $stream = [
        'slug' => 'advs',
    ];

    protected $fields = [
        "user_status" => [
            "type"   => "anomaly.field_type.relationship",
            "config" => [
                "related" => \Visiosoft\AdvsModule\Status\StatusModel::class,
                "mode" => "lookup",
            ]
        ],
    ];

    protected $assignments = [
        'user_status',
    ];
}
