<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAdcount extends Migration
{

    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'adcount' => 'anomaly.field_type.integer',
        'adcount_updateat' => 'anomaly.field_type.datetime'
    ];

    protected $assignments = [
        'adcount' => []
    ];

}
