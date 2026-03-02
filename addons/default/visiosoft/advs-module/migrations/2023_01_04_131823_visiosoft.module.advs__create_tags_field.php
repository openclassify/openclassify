<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateTagsField extends Migration
{

    protected $stream = [
        'slug' => 'advs',
        'title_column' => 'tags',
    ];

    protected $fields = [
        'tags' => [
            'type' => 'anomaly.field_type.tags',
        ],
    ];

    protected $assignments = [
        'tags'
    ];


}
