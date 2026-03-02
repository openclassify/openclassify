<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateConfigFields extends Migration
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
        'config' => 'visiosoft.field_type.json',
    ];

    protected $assignments = [
        'config'
    ];
}
