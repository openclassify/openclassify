<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateShowPhoneNumberField extends Migration
{
    public function __construct()
    {
        //Maria DB will be removed when the version is updated.
        \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'string');
    }

    protected $delete = false;

    protected $stream = [
        'slug' => 'advs',
    ];

    protected $fields = [
        'show_phone_number' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
                'mode' => 'checkbox',
            ],
        ],
    ];

    protected $assignments = [
        'show_phone_number'
    ];
}
