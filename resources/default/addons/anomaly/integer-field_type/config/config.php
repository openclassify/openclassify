<?php

return [
    'separator'     => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'default_value' => ',',
            'options'       => [
                ''       => '1000',
                ','      => '1,000',
                '.'      => '1.000',
                '`'      => '1`000',
                '&#160;' => '1 000',
            ],
        ],
    ],
    'min'           => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => null,
        ],
    ],
    'max'           => [
        'type' => 'anomaly.field_type.integer',
    ],
    'step'          => [
        'type' => 'anomaly.field_type.integer',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.integer',
    ],
];
