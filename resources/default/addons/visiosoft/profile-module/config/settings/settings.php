<?php

return [
    'upload_avatar' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'show_my_ads' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'show_tax_office' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'google_captcha_site_key' => [
        'type' => 'anomaly.field_type.text',
    ],
    'google_captcha_secret_key' => [
        'type' => 'anomaly.field_type.text',
    ],
    "score_threshold" => [
        "type"   => "anomaly.field_type.decimal",
        "config" => [
            "default_value" => 0.5,
            "decimals"  => 1,
            "min"       => 0.0,
            "max"       => 1.0,
        ]
    ],
    'show_checkbox_terms_on_register' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    'register_protection_url' => [
        'type' => 'anomaly.field_type.url',
        'config' => [
            'default_value' => '#',
        ]
    ],
    'register_privacy_url' => [
        'type' => 'anomaly.field_type.url',
        'config' => [
            'default_value' => '#',
        ]
    ],
    'show_education_profession' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'mode' => 'checkbox'
        ]
    ],
    'hide_register_type_profile' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'mode' => 'checkbox'
        ]
    ],
    "education" => "anomaly.field_type.tags",
    "state_of_education" => "anomaly.field_type.tags",
    "profession" => "anomaly.field_type.tags",
    'required_district' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ]
    ],
    'show_extends_actions' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ]
    ],
];