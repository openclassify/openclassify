<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\AdvsModule\City\CityModel;
use Visiosoft\AdvsModule\CustomField\CustomFieldModel;
use Visiosoft\AdvsModule\District\DistrictModel;
use Visiosoft\AdvsModule\Neighborhood\NeighborhoodModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksBlocksEntryModel;
use Anomaly\Streams\Platform\Model\HtmlBlock\HtmlBlockBlocksEntryModel;
use Illuminate\Support\Facades\DB;

class VisiosoftModuleAdvsCreateAdvsFields extends Migration
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
        'description' => 'anomaly.field_type.textarea',
        'advs_desc' => [
            'type' => 'anomaly.field_type.wysiwyg',
            'config' => [
                'height' => 500,
            ],
        ],
        'cat1' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => 0,
            ]
        ],
        'cat2' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat3' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat4' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat5' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat6' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat7' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat8' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat9' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'cat10' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                "default_value" => NULL,
            ]
        ],
        'parent_category' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CategoryModel::class,
                "default_value" => 0,
            ]
        ],
        'status' => [
            'type' => 'anomaly.field_type.text',
            'config' => [
                'type' => 'text',
                'default_value' => 'pending_user'
            ]
        ],
        'order' => 'anomaly.field_type.integer',
        'price' => [
            'type' => 'visiosoft.field_type.decimal',
            'config' => [
                'decimal' => 2,
                'separator' => '.',
                'point' => ','
            ],
        ],
        'currency' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'handler' => 'currencies',
            ],
        ],
        'stock' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'online_payment' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
                'min' => 0,
                'max' => 9,
            ]
        ],
        'is_get_adv' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'files' => [
            'type' => 'visiosoft.field_type.media',
            'config' => [
                'folders' => ["images"],
                'mode' => 'upload',
            ]
        ],
        'country' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CountryModel::class,
                "default_value" => 0,
            ]
        ],
        'city' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'district' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'neighborhood' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'village' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'map_Val' => "anomaly.field_type.text",
        'parent_country_id' => 'anomaly.field_type.integer',
        'parent_city_id' => 'anomaly.field_type.integer',
        'parent_district_id' => 'anomaly.field_type.integer',
        'parent_neighborhood_id' => 'anomaly.field_type.integer',
        'publish_at' => 'anomaly.field_type.datetime',
        'finish_at' => 'anomaly.field_type.datetime',
        'custom_field_category' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CustomFieldModel::class,
            ],
        ],
        'parent_adv' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => AdvModel::class,
            ],
        ],
        'custom_field_value' => 'anomaly.field_type.text',
        'type' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'options' => ['text' => 'Text Box', 'select' => 'Secim Alani(Select Box)', 'checkboxes' => 'Coklu Secim(Check Box)', 'multiple' => 'Cok Satirli Alan(Multi Line Box)', 'integer' => 'Tam Sayi', 'colorpicker' => 'Color Picker'],
                'separator' => ':',
            ]
        ],
        'custom_field_select_options' => 'anomaly.field_type.text',
        'popular_adv' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'adv_day' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'custom_field_type' => "anomaly.field_type.text",
        'cf_json' => "visiosoft.field_type.json",
        'foreign_currencies' => 'visiosoft.field_type.json',
        'deleted_at' => "anomaly.field_type.datetime",
        'value' => 'anomaly.field_type.text',
        'cover_photo' => 'anomaly.field_type.text',
        'category_id' => 'anomaly.field_type.integer',
        'field_id' => 'anomaly.field_type.integer',
        'custom_field' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CustomFieldModel::class,
            ],
        ],
        'count_show_phone' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'count_show_ad' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0,
            ]
        ],
    ];
}
