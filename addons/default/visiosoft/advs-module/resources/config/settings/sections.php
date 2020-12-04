<?php

return [
    'monitoring' => [
        'stacked' => true,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.advs::section.general',
                'fields' => [
                    'market_place',
                    'show_lang_url',
                    'iban_numbers',
                    'google_statistic_code',
                    'ogImage',
                    'free_currencyconverterapi_key',
                    'enabled_currencies',
                    'tcmb_exchange_url'
                ],
            ],
            'ads' => [
                'title' => 'visiosoft.module.advs::section.ads',
                'fields' => [
                    'latest-limit',
                    'popular_ads_limit',
                    'default_view_type',
                    'hide_listing_standard_price',
                    'hide_zero_price',
                    'auto_approve',
                    'estimated_pending_time',
                    'default_published_time',
                    'default_GET',
                    'listing_page_image',
                ],
            ],
            'create_ad' => [
                'title' => 'visiosoft.module.advs::section.create_ad',
                'fields' => [
                    'hide_standard_price_field',
                    'hide_options_field',
                    'hide_village_field',
                    'hide_configurations',
                    'make_map_required',
                    'show_breadcrumb_when_creating_ad',
                ],
            ],
            'ads_image' => [
                'title' => 'visiosoft.module.advs::section.ads_image',
                'fields' => [
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
                    'register_email_field'
                ],
            ],
            'filter' => [
                'title' => 'visiosoft.module.advs::section.filter',
                'fields' => [
                    'hide_price_filter', 'hide_date_filter', 'hide_photo_filter', 'hide_map_filter', 'user_filter_limit'
                ],
            ],
            'translations' => [
                'title' => 'visiosoft.module.advs::section.translations',
                'fields' => [
                    'override_text',
                ],
            ],
        ],
    ],
];
