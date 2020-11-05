<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'general_setting' => [
                'title' => 'visiosoft.module.profile::section.general_setting',
                'fields' => [
                    'show_my_ads', 'upload_avatar', 'show_tax_office'
                ],
            ],
            'recaptcha' => [
                'title' => 'visiosoft.module.profile::section.recaptcha',
                'fields' => [
                    'google_captcha_site_key', 'google_captcha_secret_key', 'score_threshold'
                ],
            ],
        ],
    ],
];
