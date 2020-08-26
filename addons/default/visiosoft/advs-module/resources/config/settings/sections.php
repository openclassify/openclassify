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
                ],
            ],
            'ads' => [
                'title' => 'visiosoft.module.advs::section.ads',
                'fields' => [
                    'latest-limit',
                    'default_view_type',
                    'hide_zero_price',
                    'auto_approve',
                    'estimated_pending_time',
                    'default_published_time',
                    'default_GET',
                    'thumbnail_width',
                    'thumbnail_height',
                    'picture_width',
                    'picture_height',
                    'watermark_type',
                    'watermark_text',
                    'watermark_image',
                    'watermark_position',
                    'listing_page_image',
                    'hide_standard_price_field',
                ],
            ],
            'user' => [
                'title' => 'visiosoft.module.advs::section.user',
                'fields' => [
                    'register_email_field',
                ],
            ],
            'filter' => [
                'title' => 'visiosoft.module.advs::section.filter',
                'fields' => [
                    'hide_price_filter','hide_date_filter','hide_photo_filter','hide_map_filter'
                ],
            ],
        ],
    ],
];
