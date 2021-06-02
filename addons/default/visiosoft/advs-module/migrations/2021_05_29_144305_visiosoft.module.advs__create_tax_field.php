<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateTaxField extends Migration
{
    public function __construct()
    {
        //Maria DB will be removed when the version is updated.
        \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'string');
    }

    protected $stream = [
        'slug' => 'advs',
    ];

    protected $fields = [
        'tax' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0,
            ],
        ],
    ];

    protected $assignments = [
        'tax'
    ];
}
