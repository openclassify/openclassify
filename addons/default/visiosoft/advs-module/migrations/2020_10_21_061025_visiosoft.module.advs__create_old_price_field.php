<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateOldPriceField extends Migration
{
    protected $delete = false;

    protected $stream = [
        'slug' => 'advs',
    ];

    protected $fields = [
        'old_price' => [
            'type' => 'visiosoft.field_type.decimal',
            'config' => [
                'decimal' => 2,
                'separator' => '.',
                'point' => ','
            ],
        ],
    ];

    protected $assignments = [
        'old_price'
    ];
}
