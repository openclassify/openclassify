<?php

return [
    'default_owner' => [
        "type" => "anomaly.field_type.relationship",
        "config" => [
            "related" => '\Anomaly\UsersModule\User\UserModel',
            "mode" => "search",
            "default_value" => null,
        ]
    ],
    'shareWhatsappMsg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            'default_value' => 'See what I found on Openclassify. Just look at the details.',
        ]
    ],
    'show_country' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 0
        ],
    ],
    'show_owner_details' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'contact_info_visible_to_login_user' => 'anomaly.field_type.boolean',
    'security_tips_msg' => [
        'type' => 'anomaly.field_type.textarea',
        "config" => [
            "default_value" => "Don't make down-payment or send money before seeing the real-estate you want to buy.",
        ]
    ],
    'show_security_tips' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => 1
        ],
    ],
    'detail_bottom_mobile' => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
    'show_view_count' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => true,
            "mode" => 'checkbox',
        ]
    ],
];
