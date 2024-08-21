<?php

return [
    "logo" => "anomaly.field_type.file",
    "logo_white" => "anomaly.field_type.file",
    "home_background_image" => "anomaly.field_type.file",
    "print_logo" => "anomaly.field_type.file",
    "popular_cities" => [
        "type" => "anomaly.field_type.checkboxes",
        "config" => [
            "mode" => "tags",
            "options" => static function (\Visiosoft\LocationModule\City\CityModel $cityModel) {
                return $cityModel->all()->pluck('name', 'id')->all();
            },
        ]
    ],
    "facebook_address" => [
        "type" => "anomaly.field_type.url",
        "config" => [
            "default_value" => 'https://www.facebook.com'
        ]
    ],
    "instagram_address" => "anomaly.field_type.url",
    "twitter_address" => [
        "type" => "anomaly.field_type.url",
        "config" => [
            "default_value" => 'https://www.twitter.com'
        ]
    ],
    "linkedin_address" => [
        "type" => "anomaly.field_type.url",
        "config" => [
            "default_value" => 'https://www.linkedin.com'
        ]
    ],
    "youtube_address" => "anomaly.field_type.url",
    "app_store" => "anomaly.field_type.url",
    "android_store" => "anomaly.field_type.url",
    "footer_logo" => "anomaly.field_type.file",
    "etbis_qr" => "anomaly.field_type.file",
    "etbis_link" => "anomaly.field_type.text",
    'btn_color' => [
        'type' => 'anomaly.field_type.colorpicker',
        "config" => [
            "default_value" => '#061a46'
        ]
    ],
    'btn_color2' => [
        'type' => 'anomaly.field_type.colorpicker',
        "config" => [
            "default_value" => '#5226d2'
        ]
    ],
    'list_cats' => [
        'type' => 'anomaly.field_type.checkboxes',
        'config' => [
            'mode' => 'tags',
            'options' => function () {
                return app(\Anomaly\PostsModule\Category\CategoryModel::class)->get()->pluck('name', 'id');
            }
        ]
    ],'ad_page_target' => [
        'type' => 'anomaly.field_type.select',
        "config" => [
            "options" => [
                'current' => "visiosoft.theme.restate::setting.current_page",
                'new' => "visiosoft.theme.restate::setting.new_page",
            ],
        ]
    ],
    'header_category1' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ],
    ],
    'header_category2' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ],
    ],
    'search_cat1' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ]
    ],
    'search_cat2' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ]
    ],'search_cat3' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ]
    ],'search_cat4' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'Visiosoft\RestateTheme\SettingHandler\CategoriesOptions@handle'
        ]
    ],

    'address' => [
        'type' => 'anomaly.field_type.text',
    ],
    'phone' => [
        'type' => 'anomaly.field_type.text',
    ],
    'mail' => [
        'type' => 'anomaly.field_type.email',
    ],
    'company_name' => [
        'type' => 'anomaly.field_type.text',
    ],
    'company_desc' => [
        'type' => 'anomaly.field_type.text',
    ],
    'form_desc' => [
        'type' => 'anomaly.field_type.text',
    ],

    'mobile_intro_bg' => [
        'type' => 'anomaly.field_type.file'
    ],
    'contact_info_visible_to_login_user' => [
        'type' => 'anomaly.field_type.boolean'
    ],
    'shareWhatsappMsg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            'default_value' => 'See what I found on Openclassify. Just look at the details.',
        ]
    ],
    'default_owner' => [
        "type" => "anomaly.field_type.relationship",
        "config" => [
            "related" => '\Anomaly\UsersModule\User\UserModel',
            "mode" => "search",
            "default_value" => null,
        ]
    ],
    'footer_doping_color' => [
        'type' => 'anomaly.field_type.colorpicker',
        "config" => [
            "default_value" => '#061a46'
        ]
    ],
    'list_top_customfield' => [
        'type' => 'anomaly.field_type.relationship',
        'config' => [
            'related' => \Visiosoft\CustomFieldsModule\CustomField\CustomFieldModel::class,
        ],
    ],
    'homepage_cats_with_images' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => false
        ]
    ],
    'homepage_banner_section' => [
        'type' => 'anomaly.field_type.editor',
        "config" => [
            "default_value" => false
        ]
    ],
    'breadcrumbs' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'home_page_sub_categories_limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'min' => 0,
            'default_value' => 8
        ],
    ],
    'domains_allowed_iframe_access'=> [
        'type' => 'anomaly.field_type.tags',
    ],
];
