<?php

return [
    'mode'          => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'dropdown',
            'options'       => [
                'dropdown' => 'anomaly.field_type.select::config.mode.option.dropdown',
                'buttons'  => 'anomaly.field_type.select::config.mode.option.buttons',
                'search'   => 'anomaly.field_type.select::config.mode.option.search',
                'radio'    => 'anomaly.field_type.select::config.mode.option.radio',
            ],
        ],
    ],
    'options'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.textarea',
    ],
    'separator'     => [
        'type' => 'anomaly.field_type.text',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.text',
    ],
];
