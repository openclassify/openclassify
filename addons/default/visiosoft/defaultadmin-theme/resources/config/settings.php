<?php

return [
    'sidebar_hover' => 'anomaly.field_type.boolean',
    'navigation'    => [
        'type'       => 'anomaly.field_type.textarea',
        'input_view' => 'visiosoft.theme.defaultadmin::admin/navigation/settings',
    ],
    "login_icon" => [
        "type"   => "anomaly.field_type.file",
        "config" => [
            "folders"       => ['images'],
        ]
    ],
    "panel_icon" => [
        "type"   => "anomaly.field_type.file",
        "config" => [
            "folders"       => ['images'],
        ]
    ],
    "title" => [
        "type"   => "anomaly.field_type.text",
        "config" => [
            "default_value" => 'OpenClassify',
        ]
    ],
    "footer_copyright_org_name" => [
        "type"   => "anomaly.field_type.text",
        "config" => [
            "default_value" => 'OpenClassify, Inc',
        ]
    ],
    "sidebar_main_color" => [
        "type"   => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#273759',
        ]
    ],
    "sidebar_secondary_color" => [
        "type"   => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#30426A',
        ]
    ],
    "active_sidebar_border_color" => [
        "type"   => "anomaly.field_type.colorpicker",
        "config" => [
            "default_value" => '#2BBF98',
        ]
    ],
];
