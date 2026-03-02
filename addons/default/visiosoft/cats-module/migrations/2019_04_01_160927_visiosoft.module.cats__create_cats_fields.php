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
        'deleted_at' => "anomaly.field_type.datetime",
        'icon' => [
            'type' => 'anomaly.field_type.file',
            'config' => [
                'folders' => ["images"],
                'mode' => 'upload',
            ]
        ],
        'seo_keyword' => 'anomaly.field_type.tags',
        'seo_description' => 'anomaly.field_type.text',

    ];

}
