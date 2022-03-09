<?php

return [
    'type'          => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                'tel'      => 'anomaly.field_type.text::config.type.option.tel',
                'text'     => 'anomaly.field_type.text::config.type.option.text',
                'email'    => 'anomaly.field_type.text::config.type.option.email',
                'password' => 'anomaly.field_type.text::config.type.option.password',
            ],
        ],
    ],
    'mask'          => [
        'type' => 'anomaly.field_type.text',
    ],
    'min'           => [
        'type' => 'anomaly.field_type.integer',
    ],
    'max'           => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'max' => 255,
        ],
    ],
    'show_counter'  => [
        'type' => 'anomaly.field_type.boolean',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.text',
    ],
];
