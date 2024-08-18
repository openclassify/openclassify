<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateMinOrderLimitField extends Migration
{

    protected $stream = [
        'slug' => 'advs',
        'title_column' => 'min_order_limit',
    ];

    protected $fields = [
        'min_order_limit' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0,
                'required' => false
            ],
        ],
    ];

    protected $assignments = [
        'min_order_limit'
    ];

}
