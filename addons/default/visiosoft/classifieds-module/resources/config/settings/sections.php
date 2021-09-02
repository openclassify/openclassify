<?php

return [
    'monitoring' => [
        'stacked' => true,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.classifieds::section.general',
                'fields' => [
                	'favicon',
                    'market_place',
                    'show_lang_url',
                    'iban_numbers',
                    'google_statistic_code',
                    'ogImage',
                    'free_currencyconverterapi_key',
                    'hide_price_categories',
                    'tcmb_exchange_url',
                    'enabled_currencies',
	                'hide_classified_cat',
                ],
            ],
            'classifieds' => [
                'title' => 'visiosoft.module.classifieds::section.classifieds',
                'fields' => [
                    'show_finish_and_publish_date',
                    'latest-limit',
                    'popular_classifieds_limit',
                    'classifieds_image_limit',
                    'default_view_type',
	                'show_price_to_members_only',
                    'price_area_hidden',
                    'hide_listing_standard_price',
                    'hide_zero_price',
                    'auto_approve',
                    'estimated_pending_time',
                    'default_published_time',
                    'default_GET',
                    'get_categories',
                    'listing_page_image',
                    'show_classifieds_count',
                    'show_subcats_mobile',
                ],
            ],
	        'classifieds_detail' => [
	        	'title' => 'visiosoft.module.classifieds::section.classifieds_detail',
		        'fields' => [
			        'classifieds_date_hidden',
			        'hide_seller_info',
		        ]
	        ],
            'create_classified' => [
                'title' => 'visiosoft.module.classifieds::section.create_classified',
                'fields' => [
                	'hide_contact_created_at',
                    'show_tax_field',
                    'detailed_product_options',
                    'steps_color',
                    'create_classified_button_color',
                    'hide_standard_price_field',
                    'hide_options_field',
                    'hide_village_field',
                    'hide_configurations',
                    'make_all_fields_required',
                    'make_map_required',
                    'show_breadcrumb_when_creating_classified',
                    'show_post_classified_agreement',
                    'show_input_flag',
                ],
            ],
            'classifieds_image' => [
                'title' => 'visiosoft.module.classifieds::section.classifieds_image',
                'fields' => [
                    'watermark',
                    'image_resize_backend',
                    'full_image_width',
                    'full_image_height',
                    'medium_image_width',
                    'medium_image_height',
                    'thumbnail_width',
                    'thumbnail_height',
                    'add_canvas',
                    'image_canvas_width',
                    'image_canvas_height',
                    'watermark_type',
                    'watermark_text',
                    'watermark_image',
                    'watermark_position',
                ],
            ],
            'user' => [
                'title' => 'visiosoft.module.classifieds::section.user',
                'fields' => [
                    'register_email_field', 'only_email_login'
                ],
            ],
            'filter' => [
                'title' => 'visiosoft.module.classifieds::section.filter',
                'fields' => [
                    'hide_filter_section', 'hide_price_filter', 'hide_date_filter', 'hide_photo_filter', 'hide_map_filter',
	                'hide_listing_header', 'user_filter_limit','hide_out_of_stock_products_without_listing'
                ],
            ],
            'translations' => [
                'title' => 'visiosoft.module.classifieds::section.translations',
                'fields' => [
                    'lang_switcher_for_browser',
                    'override_text',
                ],
            ],
        ],
    ],
];
