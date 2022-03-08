<?php

return [
    'min'             => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'             => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'filter'          => [
        'type'   => 'anomaly.field_type.tags',
        'config' => [
            'options' => [
                'FILTER_VALIDATE_EMAIL',
                'FILTER_VALIDATE_IP',
                'FILTER_VALIDATE_URL',
            ],
        ],
    ],
    'options'         => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'enforce_options' => [
        'type' => 'anomaly.field_type.boolean',
    ],
    'default_value'   => [
        'type' => 'anomaly.field_type.tags',
    ],
];
