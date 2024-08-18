<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldModel;

class VisiosoftModuleCustomfieldsCreateCustomfieldsFields extends Migration
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
            'type' => 'anomaly.field_type.select',
            'config' => [
                'separator' => ':',
            ]
        ],
        'custom_field_value' => 'anomaly.field_type.text',
        'custom_field_image' => [
            'type' => 'anomaly.field_type.file',
            'config' => [
                'folders' => ['images']
            ]
        ],
        'type' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'options' => ['text' => 'Text Box', 'select' => 'Secim Alani(Select Box)', 'checkboxes' => 'Coklu Secim(Check Box)', 'multiple' => 'Cok Satirli Alan(Multi Line Box)', 'integer' => 'Tam Sayi', 'colorpicker' => 'Color Picker'],
                'separator' => ':',
            ]
        ],
        // 'custom_field_select_options' => 'anomaly.field_type.text',
        'description' => 'anomaly.field_type.textarea',
        'custom_field' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CustomFieldModel::class,
                "default_value" => 0,
            ]
        ],
        'seenList' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'cat_id' => 'anomaly.field_type.integer',
        'cf_id' => 'anomaly.field_type.integer'
    ];

}
