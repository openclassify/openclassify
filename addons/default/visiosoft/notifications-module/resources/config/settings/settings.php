<?php

return [
    'user_notifications' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'admin_notifications' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'new_ad_user_sms' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'payment_user_sms' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'status_ad_user_sms' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'unpublish_ad_user_sms' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'update_ad_user_sms' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'sms_extension' => [
        'type' => 'anomaly.field_type.select',
        'config' => [
            'default_value' => 'netgsm',
            "options"       => ['netgsm' => 'NETGSM', 'kanyon' => 'Kanyon SMS'],
            "separator"     => ":",
        ],
    ],
    'mail_header' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'mail_footer' => [
        'type' => 'anomaly.field_type.wysiwyg'
    ],
];
