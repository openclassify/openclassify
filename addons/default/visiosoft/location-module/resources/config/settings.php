<?php

return [
    'home_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'list_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'detail_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'create_ad_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],    'default_country' => [
        'type' => 'anomaly.field_type.relationship',
        "config" => [
            "related" => \Visiosoft\LocationModule\Country\CountryModel::class,
            'default_value' => 212,
        ]
    ],
];
