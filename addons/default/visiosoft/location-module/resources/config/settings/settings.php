<?php


return [
    'home_page_location' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'list_page_location' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'detail_page_location' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'create_ad_page_location' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'default_country' => [
        'type' => 'anomaly.field_type.relationship',
        "config" => [
            "related" => \Visiosoft\LocationModule\Country\CountryModel::class,
            'default_value' => 212,
        ]
    ],
    'default_city' => [
        'type' => 'anomaly.field_type.select',
    ],
    'default_district' => [
        'type' => 'anomaly.field_type.select',
    ],
    'default_neighborhood' => [
        'type' => 'anomaly.field_type.select',
    ],

    'google_map_key' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.google_map_key',
        'env' => 'ADV_MAP_KEY',
        'config' => [
            'default_value' => 'AIzaSyCAGc0z8kg9rKGVy2FizFKoz0FoWWWzoGQ',
        ],
    ],

    'map_coordinates_long' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.map_coordinates_long',
        'env' => 'ADV_MAP_LONG',
        'config' => [
            'default_value' => '28.74558607285155',
        ],
    ],
    'map_coordinates_lat' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.map_coordinates_lat',
        'env' => 'ADV_MAP_LAT',
        'config' => [
            'default_value' => '40.97817786299617',
        ],
    ],
];