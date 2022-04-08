<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'general_setting' => [
                'title' => 'visiosoft.module.profile::section.general_setting',
                'fields' => [
                    'show_extends_actions',
                    'required_district',
                    'show_my_ads',
                    'upload_avatar',
                    'show_tax_office',
                    'show_checkbox_terms_on_register',
                    'register_protection_url',
                    'register_privacy_url',
                    'hide_register_type_profile',
                    'show_education_profession',
                    'education',
                    'state_of_education',
                    'profession',
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
