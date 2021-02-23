<?php
use \Visiosoft\LocationModule\Country\CountryModel;
return [
    'navigation_title' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'navigation_action' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'date_fields' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'price_fields' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'breadcrumbs' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'ad_details' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'ad_details_tab' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'latest_and_view_all_btn' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'register_page_instruction_logo' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'register_page_alert_link' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            "default_value" => "/",
        ]
    ],
    "home_page_sub_categories_limit" => [
        "type"   => "anomaly.field_type.integer",
        "config" => [
            "default_value" => 5,
        ]
    ],
    'style' => [
        'type' => 'anomaly.field_type.editor',
    ],
    "header_primary_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#3f475f',
        ]
    ],
    "header_secondary_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#2f3546',
        ]
    ],
    "header_text_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#000000',
        ]
    ],
    "mobile_header_text_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#fff',
        ]
    ],
    "footer_primary_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#f9f9f9',
        ]
    ],
    "footer_secondary_color" => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#fff',
        ]
    ],
    "ad_detail_color_scheme" => [
        "type" => "anomaly.field_type.colorpicker",
    ],
    'home_ad_height' => [
        'type' => 'anomaly.field_type.integer',
        'warning' => "100px default",
        'config' => [
            'min' => 40,
            'default_value' => 100
        ],
    ],
    'logo_web' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'left_menu_side' => [
        'type' => 'anomaly.field_type.select',
        "config" => [
            "options" => [
                'left' => "visiosoft.theme.base::setting.left.name",
                'right' => "visiosoft.theme.base::setting.right.name",
            ],
            "default_value" => 'left',
            "mode" => "radio",
        ]
    ],
    'logo_mobile' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    "favicon" => [
        "type" => "anomaly.field_type.file",
        "config" => [
            "folders" => ['favicon'],
            "mode" => "upload",
        ]
    ],
    'help_phone' => [
        'type' => 'anomaly.field_type.text',
        "config" => [
            'type' => 'tel',
            'mask' => '0(999) 999-9999'
        ]
    ],
    'banner_web' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'banner_mobile' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'banner_link_new_tab' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => true,
        ]
    ],
    'show_banner' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => true,
        ]
    ],
    'warning_message' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            "default_value" => "The ad creator is solely responsible for the content, correctness, accuracy and legal obligation of all posted ads, entries, ideas and information. openclassify.com is not in any way responsible for the quality or legality of content created and posted by its users. You should contact the ad creator directly with your questions.",
        ]
    ],
    'facebook' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'twitter' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'linkedin' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'instagram' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'youtube' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'show_country' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 0
        ],
    ],
    'default_owner' => [
        "type" => "anomaly.field_type.relationship",
        "config" => [
            "related" => '\Anomaly\UsersModule\User\UserModel',
            "mode" => "search",
            "default_value" => null,
        ]
    ],
    'show_owner_details' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'security_tips_msg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            "default_value" => "Don't make down-payment or send money before seeing the real-estate you want to buy.",
        ]
    ],
    'show_security_tips' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
//    Advertising Area Start
    //for web
    'home_bottom_left_categories' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_bottom' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_top_latestAds' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_bottom_latestAds' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'detail_bottom' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],

    //for mobile
    'detail_bottom_mobile' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_bottom_mobile' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],

//    Advertising Area Stop

    'banner_web_link' => [
        'type' => 'anomaly.field_type.url',
        'config' => [
            'default_value' => '#',
        ],
    ],
    'banner_mobile_link' => [
        'type' => 'anomaly.field_type.url',
        'config' => [
            'default_value' => '#',
        ],
    ],

    'playstore' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'appstore' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            'default_value' => '#',
        ]
    ],
    'shareWhatsappMsg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            'default_value' => 'See what I found on Openclassify. Just look at the details.',
        ]
    ],
    'show_navigation_switch_language' => 'anomaly.field_type.boolean',
    'show_subcategories_on_mobile_view' => 'anomaly.field_type.boolean',
    'contact_info_visible_to_login_user' => 'anomaly.field_type.boolean',
];