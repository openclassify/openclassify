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
        'bind' => 'classified.auto_approve',
        'env' => 'CLASSIFIED_AUTO_APPROVE',
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
        'bind' => 'classified.default_published_time',
        'env' => 'CLASSIFIED_PUBLISH_TIME',
        'required' => true,
        'config' => [
            'default_value' => 10,
        ],
    ],

    'iban_numbers' => [
        'type' => 'anomaly.field_type.wysiwyg',
        'bind' => 'classified.iban',
        'env' => 'CLASSIFIED_IBAN',
        'config' => [
            'default_value' => '<h3>TR00 0000 0000 0000 0000 0000 00</h3>',
        ],
    ],

    'google_statistic_code' => [
        'type' => 'anomaly.field_type.editor',
        'bind' => 'classified.google_statistic_code',
        'env' => 'CLASSIFIED_GOOGLE_STATISTIC_CODE',
        'config' => [
            'default_value' => '',
        ],
    ],
    'logo' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'classified.logo',
        'env' => 'CLASSIFIED_LOGO',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'ogImage' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'classified.ogImage',
        'env' => 'CLASSIFIED_OG_IMAGE',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'free_currencyconverterapi_key' => [
        "type" => "anomaly.field_type.text",
        'bind' => 'classified.free_currencyconverterapi_key',
        'env' => 'CLASSIFIED_CURRENCY_CONVERT_API_KEY',
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
        'bind' => 'classified.default_GET',
        'env' => 'CLASSIFIED_GET',
        'config' => [
            'default_value' => 0,
        ],
    ],

    'listing_page_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'classified.listing_page_image',
        'env' => 'CLASSIFIED_LISTING_PAGE_IMAGE',
        'config' => [
            'folders' => ["classified_listing_page"],
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
    'hide_configurations' => [
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
        'env' => 'CLASSIFIED_ENABLED_CURRENCIES',
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

    'popular_classifieds_limit' => [
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
        'bind' => 'classified.watermark_type',
        'env' => 'CLASSIFIED_WATERMARK_TYPE',
        'required' => true,
        'config' => [
            'options' => ['image' => 'Image', 'text' => 'Text'],
            'default_value' => 'text',
        ]
    ],
    'watermark_text' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'classified.watermark_text',
        'env' => 'CLASSIFIED_WATERMARK_TEXT',
    ],
    'watermark_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'classified.watermark_image',
        'env' => 'CLASSIFIED_WATERMARK_IMAGE',
    ],
    'watermark_position' => [
        'type' => 'anomaly.field_type.select',
        'bind' => 'classified.watermark_position',
        'env' => 'CLASSIFIED_WATERMARK_POSITION',
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
    'show_breadcrumb_when_creating_classified' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'mode' => 'checkbox'
        ],
    ],
    'show_classifieds_count' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'mode' => 'checkbox'
        ],
    ],
    'show_post_classified_agreement' => [
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
    'create_classified_button_color' => [
        "type" => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#00a651',
        ]
    ],
    'classifieds_image_limit' => [
        "type" => "anomaly.field_type.integer",
        "config" => [
            "default_value" => 25
        ]
    ],
    'lang_switcher_for_browser' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'classifieds.lang_switcher_for_browser',
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
    'classifieds_date_hidden' => [
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
    'hide_classified_cat' => [
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
];
