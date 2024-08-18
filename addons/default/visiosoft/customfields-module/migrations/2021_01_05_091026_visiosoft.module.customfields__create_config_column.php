<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsCreateConfigColumn extends Migration
{

    protected $stream = [
        'slug' => 'custom_fields',
    ];

    protected $fields = [
        'config' => "visiosoft.field_type.json",
    ];

    protected $assignments = [
        'config'
    ];
}
