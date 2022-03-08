<?php

return [
    'mode'          => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => config('anomaly.field_type.boolean::input.mode', 'switch'),
            'options'       => [
                'switch'   => 'anomaly.field_type.boolean::config.mode.option.switch',
                'checkbox' => 'anomaly.field_type.boolean::config.mode.option.checkbox',
                'dropdown' => 'anomaly.field_type.boolean::config.mode.option.dropdown',
                'radio'    => 'anomaly.field_type.boolean::config.mode.option.radio',
            ],
        ],
    ],
    'label'         => [
        'type' => 'anomaly.field_type.text',
    ],
    'on_text'       => [
        'type' => 'anomaly.field_type.text',
    ],
    'on_color'      => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => 'success',
            'options'       => [
                'success' => 'anomaly.field_type.boolean::config.on_color.option.green',
                'info'    => 'anomaly.field_type.boolean::config.on_color.option.blue',
                'warning' => 'anomaly.field_type.boolean::config.on_color.option.orange',
                'danger'  => 'anomaly.field_type.boolean::config.on_color.option.red',
                'default' => 'anomaly.field_type.boolean::config.on_color.option.gray',
            ],
        ],
    ],
    'off_text'      => [
        'type' => 'anomaly.field_type.text',
    ],
    'off_color'     => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => 'default',
            'options'       => [
                'success' => 'anomaly.field_type.boolean::config.off_color.option.green',
                'info'    => 'anomaly.field_type.boolean::config.off_color.option.blue',
                'warning' => 'anomaly.field_type.boolean::config.off_color.option.orange',
                'danger'  => 'anomaly.field_type.boolean::config.off_color.option.red',
                'default' => 'anomaly.field_type.boolean::config.off_color.option.gray',
            ],
        ],
    ],
    'default_value' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'on_text'       => 'anomaly.field_type.boolean::config.default_value.option.on',
            'off_text'      => 'anomaly.field_type.boolean::config.default_value.option.off',
        ],
    ],
];
