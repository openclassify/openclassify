<?php

return [
    'meta_tags' => [
        'type' => 'anomaly.field_type.tags',
        'config' => [
            'default_value' => ['Openclassify'],
        ],
    ],
    'template'    => [
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'default',
            'options'       => [
                'default'   => 'Default',
                's'   => 'S-Type',
            ],
        ],
    ],

    's-type-latest-limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 36,
            'min' => 12,
        ],
    ],
    's-type-showcase-limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 12,
            'min' => 12,
        ],
    ],
    's-type-banner-code' => [
        'type' => 'anomaly.field_type.editor',
    ],
    's-type-banner-mobile-code' => [
        'type' => 'anomaly.field_type.editor',
    ],

    'show_post_your_add_btn' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'show_home_search_on_map_btn' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'show_last_search_btn' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'header_openclassify_btn' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
];
