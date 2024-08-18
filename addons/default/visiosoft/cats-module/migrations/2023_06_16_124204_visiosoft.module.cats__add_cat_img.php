<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAddCatImg extends Migration
{

    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'image' => [
            'type' => 'anomaly.field_type.file',
            'config' => [
                'folders' => ["images"],
                'mode' => 'upload',
            ]
        ],
    ];


    protected $assignments = [
        'image'
    ];
}
