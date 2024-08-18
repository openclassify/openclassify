<?php

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
    'style' => [
        'type' => 'anomaly.field_type.editor',
    ],
    'gallery_box_height' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 500
        ],
    ],
    'domains_allowed_iframe_access'=> [
        'type' => 'anomaly.field_type.tags',
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
            "default_value" => '#EBEBEB',
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
                'left' => "visiosoft.theme.sahibinden::setting.left.name",
                'right' => "visiosoft.theme.sahibinden::setting.right.name",
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
    ],
    'work_hours' => [
        'type' => 'anomaly.field_type.text',
        "config" => [
            'type' => 'tel',
            'mask' => '99:99-99:99'
        ]
    ],
    'banner_web' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'search_banner_web' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'search_banner_color' => [
        'type' => 'anomaly.field_type.colorpicker',
        "config" => [
            "default_value" => '#CF1406',
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
    'show_search_banner' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => true,
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
//    Advertising Area Start
    //for web
    'home_bottom_left_categories' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_bottom' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],

    'home_bottom_col_1' => [
        'type' => 'anomaly.field_type.wysiwyg'
    ],
    'home_bottom_col_2' => [
        'type' => 'anomaly.field_type.wysiwyg'
    ],

    'home_top_latestAds' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'home_bottom_latestAds' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],

    //for mobile
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
    'home_page_sub_categories_limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'min' => 0,
            'default_value' => 8
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

	'show_subcategories_on_mobile_view' => 'anomaly.field_type.boolean',
	'show_change_currency' => 'anomaly.field_type.boolean',
	'desktop_payment_band' => [
		'type' => 'anomaly.field_type.file',
		'config' => [
			'folders' => ['images']
		]
	],
	'mobile_payment_band' => [
		'type' => 'anomaly.field_type.file',
		'config' => [
			'folders' => ['images']
		],
	],
	'description_active' => [
		'type' => 'anomaly.field_type.boolean',
		'config' => [
			'default_value' => false,
		]
	],
	'show_cart' => [
		'type' => 'anomaly.field_type.boolean',
		'config' => [
			'default_value' => false,
		]
	],
	'contact_email' => [
		'type' => 'anomaly.field_type.text',
		'config' => [
			'type' => 'email'
		]
	],
    'open_links_in_new_tab' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    "enable_footer_tabs" => [
        "type" => "anomaly.field_type.boolean",
        "config" => [
            "default_value" => false,
        ]
    ],
    "show_price_and_location_main_page" => [
        "type" => "anomaly.field_type.boolean",
        "config" => [
            "default_value" => false,
        ]
    ],
    "share_after_new_ad" => [
        "type" => "anomaly.field_type.boolean",
        "config" => [
            "default_value" => false,
        ]
    ],
    'company_directory_img' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'popular_ads_img' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'last_48_hours_img' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'get_ads_img' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'fire_icon' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'price_icon' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
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
    'shareWhatsappMsg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            'default_value' => 'See what I found on Openclassify. Just look at the details.',
        ]
    ],
    'show_country' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 0
        ],
    ],
    'show_owner_details' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'contact_info_visible_to_login_user' => 'anomaly.field_type.boolean',
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
    'detail_bottom' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'detail_bottom_mobile' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'show_view_count' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => true,
            "mode" => 'checkbox',
        ]
    ],
    'show_report_fav' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false
        ]
    ],
    'enable_print_button' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true
        ]
    ],
    'scroll_detail' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false
        ]
    ]
];
