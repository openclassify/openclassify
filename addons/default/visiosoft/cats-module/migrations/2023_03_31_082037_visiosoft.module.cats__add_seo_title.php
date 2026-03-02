<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAddSeoTitle extends Migration
{
    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'seo_title' => [
            'type' => 'anomaly.field_type.text',
            'config' => [
                'translatable' => true,
                'default_value' => null,
                'allow_html' => true,
            ],
        ],
    ];


    protected $assignments = [
        'seo_title'=> [
            'translatable' => true
        ],
    ];

}
