<?php
use \Visiosoft\LocationModule\Country\CountryModel;
return [
    'navigation_title' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'navigation_action' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'date_fields' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'price_fields' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'breadcrumbs' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'ad_details' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'ad_details_tab' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'latest_and_view_all_btn' => [
        'type' => 'anomaly.field_type.boolean',
        "config" => [
            "default_value" => 1,
        ]
    ],
    'register_page_instruction_logo' => [
        'type' => 'anomaly.field_type.file',
        "config" => [
            "folders" => ['images'],
            "mode" => "upload",
        ]
    ],
    'register_page_alert_link' => [
        'type' => 'anomaly.field_type.url',
        "config" => [
            "default_value" => "/",
        ]
    ],
    "home_page_sub_categories_limit" => [
        "type"   => "anomaly.field_type.integer",
        "config" => [
            "default_value" => 5,
        ]
    ],
    'style' => [
        'type' => 'anomaly.field_type.editor',
    ],
];