<?php

return [
    'min'           => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 1,
        ],
        'rules'    => [
            'numeric',
        ],
    ],
    'max'           => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 10,
        ],
        'rules'    => [
            'numeric',
        ],
    ],
    'step'          => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 1,
        ],
        'rules'    => [
            'numeric',
        ],
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.text',
    ],
    'unit' => [
        'type' => 'anomaly.field_type.text',
    ],
];
