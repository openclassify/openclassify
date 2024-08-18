<?php

return [
    'monitoring' => [
        'stacked' => true,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.advs::section.general',
                'fields' => [
                    'favicon',
                    'market_place',
                    'show_lang_url',
                    'iban_numbers',
                    'google_statistic_code',
                    'body_custom_space',
                    'ogImage',
                    'hide_price_categories',
                    'tcmb_exchange_url',
                    'enabled_currencies',
                    'hide_ad_cat',
                    'showDetailedAddress',
                    'translatable_slug'
                ],
            ],
            'ads' => [
                'title' => 'visiosoft.module.advs::section.ads',
                'fields' => [
                    'extend_ad',
                    'preview_mode',
                    'show_gifs_listing_main_pages',
                    'latest-limit',
                    'popular_ads_limit',
                    'ads_image_limit',
                    'default_view_type',
                    'show_price_to_members_only',
                    'hide_zero_price',
                    'auto_approve',
                    'estimated_pending_time',
                    'default_published_time',
                    'default_GET',
                    'get_categories',
                    'listing_page_image',
                    'show_ads_count',
                    'show_subcats_mobile',
                    'update_publish_at'
                ],
            ],
            'ads_detail' => [
                'title' => 'visiosoft.module.advs::section.ads_detail',
                'fields' => [
                    'ads_date_hidden',
                    'hide_seller_info',
                    'hide_seller_info_by_category',
                ]
            ],
            'create_ad' => [
                'title' => 'visiosoft.module.advs::section.create_ad',
                'fields' => [
                    'is_changeable_slug',
                    'hide_contact_created_at',
                    'detailed_product_options',
                    'create_ad_button_color',
                    'title_length',
                    'show_ad_note',
                    'is_desc_required',
                    'hide_options_field',
                    'hide_village_field',
                    'make_all_fields_required',
                    'make_map_required',
                    'show_breadcrumb_when_creating_ad',
                    'show_post_ad_agreement',
                    'show_input_flag',
                    'show_order_note',
                    'show_min_order_limit',
                    'add_ad_tags',
                    'is_country_required',
                    'is_city_required',
                    'is_district_required',
                    'is_neighborhood_required',
                    'show_seo_title',
                    'show_seo_description',
                ],
            ],
            'ads_image' => [
                'title' => 'visiosoft.module.advs::section.ads_image',
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
                'title' => 'visiosoft.module.advs::section.user',
                'fields' => [
                    'register_email_field', 'only_email_login'
                ],
            ],
            'filter' => [
                'title' => 'visiosoft.module.advs::section.filter',
                'fields' => [
                    'hide_filter_section',
                    'hide_date_filter', 'hide_photo_filter', 'hide_map_filter',
                    'hide_listing_header', 'user_filter_limit', 'hide_out_of_stock_products_without_listing', 'location_data_type_first'
                    , 'location_data_type_second'
                ],
            ],
            'translations' => [
                'title' => 'visiosoft.module.advs::section.translations',
                'fields' => [
                    'lang_switcher_for_browser',
                    'override_text',
                ],
            ],
            'eids' => [
                'title' => "Eids",
                'fields' => [
                    'is_eids_verification_required',
                    'eids_verification_url'
                ]
            ]
        ],
    ],
];
