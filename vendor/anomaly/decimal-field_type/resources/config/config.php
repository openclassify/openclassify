<?php

return [
    'decimals'      => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'min' => 1,
        ],
    ],
    'min'           => [
        'type' => 'anomaly.field_type.text',
    ],
    'max'           => [
        'type'  => 'anomaly.field_type.text',
        'rules' => [
            'numeric',
        ],
    ],
    'default_value' => [
        'type'  => 'anomaly.field_type.text',
        'rules' => [
            'numeric',
        ],
    ],
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
    'point'         => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => '.',
            'options'       => [
                ',' => '0,10',
                '.' => '0.10',
                '`' => '0`10',
            ],
        ],
    ],
];
