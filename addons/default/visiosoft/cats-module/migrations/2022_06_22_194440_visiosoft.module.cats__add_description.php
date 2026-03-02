<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAddDescription extends Migration
{
    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'description' => [
            'type' => 'anomaly.field_type.wysiwyg',
            'config' => [
                'translatable' => true,
                'default_value' => '',
                'allow_html' => true,
            ],
        ],
    ];


    protected $assignments = [
        'description'
    ];

}
