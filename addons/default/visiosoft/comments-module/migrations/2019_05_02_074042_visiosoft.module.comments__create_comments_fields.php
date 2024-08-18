<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\AdvsModule\Adv\AdvModel;

class VisiosoftModuleCommentsCreateCommentsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'entry' => 'anomaly.field_type.polymorphic',
        'username' => 'anomaly.field_type.text',
        'title' => 'anomaly.field_type.text',
        'rating' => 'anomaly.field_type.integer',
        'detail' => [
            "type"   => "anomaly.field_type.textarea",
            "config" => [
                "rows"  => 6
            ]
        ], 
        'status' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ]
    ];

}
