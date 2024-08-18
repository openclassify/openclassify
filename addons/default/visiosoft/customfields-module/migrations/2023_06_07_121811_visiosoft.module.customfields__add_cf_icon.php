<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsAddCfIcon extends Migration
{

    protected $stream = [
        'slug' => 'cfvalue',
    ];

    protected $fields = [
        'cf_value_icon' => [
            'type' => 'anomaly.field_type.file',
            'config' => [
                'folders' => ["images"],
                'mode' => 'upload',
            ]
        ],
    ];

    protected $assignments = [
        'cf_value_icon'
    ];
}
