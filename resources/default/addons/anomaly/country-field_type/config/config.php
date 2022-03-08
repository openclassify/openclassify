<?php

return [
    'mode'          => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'input',
            'options'       => [
                'input'    => 'anomaly.field_type.country::config.mode.option.input',
                'dropdown' => 'anomaly.field_type.country::config.mode.option.dropdown',
                'search'   => 'anomaly.field_type.country::config.mode.option.search',
            ],
        ],
    ],
    'top_options'   => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.country',
    ],
];
