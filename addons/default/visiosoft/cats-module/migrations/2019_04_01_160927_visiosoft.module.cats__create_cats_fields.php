<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\CatsModule\Category\CategoryModel;

class VisiosoftModuleCatsCreateCatsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '_'
            ],
        ],
        'parent_category' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CategoryModel::class,
                "default_value" => 0,
            ]
        ],
        'order' => 'anomaly.field_type.integer',
        'deleted_at' => "anomaly.field_type.datetime",
        'files' => [
            'type' => 'visiosoft.field_type.media',
            'config' => [
                'folders' => ["images"],
                'mode' => 'upload',
            ]
        ],
    ];

}
