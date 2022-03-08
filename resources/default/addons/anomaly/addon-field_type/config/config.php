<?php

return [
    'type'       => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'field_type' => 'streams::addon.field_types',
                'extension'  => 'streams::addon.extensions',
                'module'     => 'streams::addon.modules',
                'plugin'     => 'streams::addon.plugins',
                'theme'      => 'streams::addon.themes',
            ],
        ],
    ],
    'mode'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'dropdown',
            'options'       => [
                'dropdown' => 'anomaly.field_type.addon::config.mode.option.dropdown',
                'search'   => 'anomaly.field_type.addon::config.mode.option.search',
            ],
        ],
    ],
    'search'     => [
        'type' => 'anomaly.field_type.text',
    ],
    'theme_type' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'admin'    => 'anomaly.field_type.addon::config.theme_type.admin',
                'standard' => 'anomaly.field_type.addon::config.theme_type.public',
            ],
        ],
    ],
];
