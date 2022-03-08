<?php

return [
    'mode'          => [
        'required'    => true,
        'placeholder' => false,
        'type'        => 'anomaly.field_type.select',
        'config'      => [
            'options' => [
                'checkboxes' => 'anomaly.field_type.checkboxes::config.mode.option.checkboxes',
                'tags'       => 'anomaly.field_type.checkboxes::config.mode.option.tags',
            ],
        ],
    ],
    'options'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.textarea',
    ],
    'min'           => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'           => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'separator'     => [
        'type' => 'anomaly.field_type.text',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.tags',
    ],
];
