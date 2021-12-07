<?php

return [
    'register_email_field' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'only_email_login' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'latest-limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
            'default_value' => 5,
        ],
    ],
    'default_view_type' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'options' => ['list' => 'List', 'table' => 'Table', 'map' => 'Map', 'gallery' => 'Gallery'],
            'default_value' => 'list',
        ]
    ],
    'hide_zero_price' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'auto_approve' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'adv.auto_approve',
        'env' => 'ADV_AUTO_APPROVE',
        'config' => [
            'default_value' => true,
        ],
    ],
    'estimated_pending_time' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 6,
        ],
    ],
    'default_published_time' => [
        'type' => 'anomaly.field_type.integer',
        'bind' => 'adv.default_published_time',
        'env' => 'ADV_PUBLISH_TIME',
        'required' => true,
        'config' => [
            'default_value' => 10,
        ],
    ],

    'iban_numbers' => [
        'type' => 'anomaly.field_type.wysiwyg',
        'bind' => 'adv.iban',
        'env' => 'ADV_IBAN',
        'config' => [
            'default_value' => '<h3>TR00 0000 0000 0000 0000 0000 00</h3>',
        ],
    ],

    'google_statistic_code' => [
        'type' => 'anomaly.field_type.editor',
        'bind' => 'adv.google_statistic_code',
        'env' => 'ADV_GOOGLE_STATISTIC_CODE',
        'config' => [
            'default_value' => '',
        ],
    ],
    'body_custom_space' => [
        'type' => 'anomaly.field_type.editor',
        'bind' => 'adv.body_custom_space',
        'env' => 'ADV_BODY_CUSTOM_SPACE',
        'config' => [
            'default_value' => '',
        ],
    ],
    'logo' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.logo',
        'env' => 'ADV_LOGO',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'ogImage' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.ogImage',
        'env' => 'ADV_OG_IMAGE',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'free_currencyconverterapi_key' => [
        "type" => "anomaly.field_type.text",
        'bind' => 'adv.free_currencyconverterapi_key',
        'env' => 'ADV_CURRENCY_CONVERT_API_KEY',
        'config' => [
            "default_value" => "1eea72940f3868c77420"
        ]
    ],
    'hide_price_categories' => [
        'type' => 'anomaly.field_type.checkboxes',
        'config' => [
            'options' => function (\Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface $categoryRepository) {
                return $categoryRepository->getMainCategories()->pluck('name', 'id')->all();
            },
        ],
    ],
    'default_GET' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'adv.default_GET',
        'env' => 'ADV_GET',
        'config' => [
            'default_value' => 0,
        ],
    ],

    'listing_page_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.listing_page_image',
        'env' => 'ADV_LISTING_PAGE_IMAGE',
        'config' => [
            'folders' => ["adv_listing_page"],
            'mode' => 'upload',
        ]
    ],
    'hide_standard_price_field' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_options_field' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'hide_village_field' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'make_all_fields_required' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'make_map_required' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'hide_listing_standard_price' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'price_area_hidden' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'enabled_currencies' => [
        'bind' => 'streams::currencies.enabled',
        'env' => 'ADV_ENABLED_CURRENCIES',
        'type' => 'anomaly.field_type.checkboxes',
        'required' => true,
        'config' => [
            'mode' => 'tags',
            'default_value' => function () {
                return [config('streams::currencies.default')];
            },
            'options' => function () {
                $array = config('streams::currencies.supported');
                $cur = array();
                foreach ($array as $key => $value) {
                    $cur[$key] = $value['name'];
                }
                return $cur;
            },
        ],
    ],
    'market_place' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],

    'hide_price_filter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],

    'hide_date_filter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],

    'hide_photo_filter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_map_filter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],

    'show_lang_url' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],

    'popular_ads_limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 15,
        ],
    ],

    //Image Settings
    'image_resize_backend' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'full_image_width' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 800,
        ],
    ],
    'full_image_height' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 600,
        ],
    ],
    'medium_image_width' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 600,
        ],
    ],
    'medium_image_height' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 400,
        ],
    ],
    'thumbnail_width' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 270,
        ],
    ],
    'thumbnail_height' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 180,
        ],
    ],
    'add_canvas' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'image_canvas_width' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 800,
        ],
    ],
    'image_canvas_height' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 600,
        ],
    ],
    'watermark' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'watermark_type' => [
        'type' => 'anomaly.field_type.select',
        'bind' => 'adv.watermark_type',
        'env' => 'ADV_WATERMARK_TYPE',
        'required' => true,
        'config' => [
            'options' => ['image' => 'Image', 'text' => 'Text'],
            'default_value' => 'text',
        ]
    ],
    'watermark_text' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.watermark_text',
        'env' => 'ADV_WATERMARK_TEXT',
    ],
    'watermark_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.watermark_image',
        'env' => 'ADV_WATERMARK_IMAGE',
    ],
    'watermark_position' => [
        'type' => 'anomaly.field_type.select',
        'bind' => 'adv.watermark_position',
        'env' => 'ADV_WATERMARK_POSITION',
        'required' => true,
        'config' => [
            'options' => ['top-right' => 'Top Right', 'top-left' => 'Top Left', 'bottom-right' => 'Bottom Right',
                'bottom-left' => 'Bottom Left', 'center' => 'Middle'],
            'default_value' => 'top-right',
        ]
    ],
    'user_filter_limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 5,
        ],
    ],
    'show_breadcrumb_when_creating_ad' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'mode' => 'checkbox'
        ],
    ],
    'show_ads_count' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'mode' => 'checkbox'
        ],
    ],
    'show_post_ad_agreement' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ],
    ],
    'override_text' => [
        'type' => 'anomaly.field_type.tags',
        'bind' => 'override_text',
        'env' => 'OVERRIDE_TEXT',
    ],
    'steps_color' => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#209579',
        ]
    ],
    'create_ad_button_color' => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#00a651',
        ]
    ],
    'ads_image_limit' => [
        "type" => "anomaly.field_type.integer",
        "config" => [
            "default_value" => 25
        ]
    ],
    'lang_switcher_for_browser' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'advs.lang_switcher_for_browser',
        'env' => 'LANG_SWITCHER_FOR_BROWSER',
    ],
    'get_categories' => [
        'type' => 'anomaly.field_type.checkboxes',
        'config' => [
            'options' => function (\Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface $categoryRepository) {
                return $categoryRepository->getMainCategories()->pluck('name', 'id')->all();
            },
        ],
    ],
    'favicon' => [
        'type' => 'anomaly.field_type.file',
    ],
    'ads_date_hidden' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_listing_header' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_filter_section' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_seller_info' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_seller_info_by_category' => [
        'type' => 'anomaly.field_type.checkboxes',
        'config' => [
            'mode' => 'tags',
            'options' => function () {
                return app(\Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface::class)->getMainCategories()->pluck('name', 'id');
            },
        ],
    ],
    'detailed_product_options' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ]
    ],
    'show_subcats_mobile' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'show_price_to_members_only' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_ad_cat' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],

    'show_finish_and_publish_date' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],

    'show_tax_field' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
	'hide_contact_created_at' => [
		'type' => 'anomaly.field_type.boolean',
		'config' => [
			'default_value' => false,
		]
	],
    'show_input_flag' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'hide_out_of_stock_products_without_listing' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'preview_mode' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'adv.preview_mode',
        'config' => [
            'default_value' => true,
        ],
    ],
    'show_order_note' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
];
