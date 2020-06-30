<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\LocationModule\Country\CountryModel;

class VisiosoftModuleProfileCreateProfileFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'user' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => UserModel::class,
                "mode" => "lookup",
            ]
        ],
        'file' => [
            'type' => 'visiosoft.field_type.singlefile',
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
        'gsm_phone' => 'anomaly.field_type.text',
        'land_phone' => 'anomaly.field_type.text',
        'office_phone' => 'anomaly.field_type.text',
        'register_type' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "handler" => \Visiosoft\ProfileModule\Profile\Handler\registerType::class,
                'default_value' => 1,
            ]
        ],
        'identification_number' => 'anomaly.field_type.text',
        'adress_name' => 'anomaly.field_type.text',
        'adress_first_name' => 'anomaly.field_type.text',
        'adress_last_name' => 'anomaly.field_type.text',
        'adress_country' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CountryModel::class,
                "default_value" => 0,
            ]
        ],
        'adress_city' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'adress_district' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'adress_neighborhood' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'adress_village' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'adress_content' => 'anomaly.field_type.textarea',
        'adress_post_code' => 'anomaly.field_type.text',
        'adress_gsm_phone' => 'anomaly.field_type.text',
        'adress_land_phone' => 'anomaly.field_type.text',
        'notified_new_updates' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 1,
                'options' => [0 => 'Active', 1 => 'Passive'],
                'separator' => ':',
            ]
        ],
        'notified_about_ads' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 1,
                'options' => [0 => 'Active', 1 => 'Passive'],
                'separator' => ':',
            ]
        ],
        'receive_messages_email' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 1,
                'options' => [0 => 'Active', 1 => 'Passive'],
                'separator' => ':',
            ]
        ],
        'adv_listing_banner' => [
            'type' => 'visiosoft.field_type.singlefile',
            'config' => [
                'folders' => ['adv_listing_page'],
                'mode' => 'select',
            ]
        ],
        'company' => 'anomaly.field_type.text',
        'tax_number' => 'anomaly.field_type.text',
        'tax_office' => 'anomaly.field_type.text',
        'is_company' => [
            'type' => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
    ];

}
