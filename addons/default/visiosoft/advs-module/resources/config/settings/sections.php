<?php

return [
    'monitoring' => [
        'stacked' => true,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.advs::section.general',
                'fields' => [
                    'iban_numbers',
                    'google_statistic_code',
                    'ogImage',
                    'free_currencyconverterapi_key',
                    'enabled_currencies'
                ],
            ],
            'ads' => [
                'title' => 'visiosoft.module.advs::section.ads',
                'fields' => [
                    'latest-limit',
                    'auto_approve',
                    'estimated_pending_time',
                    'default_published_time',
                    'default_adv_limit',
                    'default_GET',
                    'watermark_type',
                    'watermark_text',
                    'watermark_image',
                    'watermark_position',
                    'listing_page_image',
                ],
            ],
            'user' => [
                'title' => 'visiosoft.module.advs::section.user',
                'fields' => [
                    'register_email_field',
                ],
            ],
        ],
    ],
];
