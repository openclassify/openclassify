<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateOptionsStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'options',
        'title_column' => 'name',
        'translatable' => false,
        'versionable' => false,
        'trashable' => false,
        'searchable' => false,
        'sortable' => false,
    ];

    /**
     * This field will be added.
     */
    protected $fields = [
        "adv" => [
            "type"   => "anomaly.field_type.relationship",
            "config" => [
                "related" => \Visiosoft\AdvsModule\Adv\AdvModel::class,
            ]
        ]
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'required' => true,
        ],
        'adv' => [
            'required' => true,
        ],
    ];

}
