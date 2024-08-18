<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateSeoFields extends Migration
{

    protected $stream = [
        'slug' => 'advs',
    ];

    protected $fields = [
        'seo_title' => [
            'type' => 'anomaly.field_type.text',
        ],
        'seo_description' => [
            'type' => 'anomaly.field_type.text',
        ],
    ];

    protected $assignments = [
        'seo_title' => [
            'translatable' => true
        ],
        'seo_description' =>  [
            'translatable' => true
        ],
    ];

}
