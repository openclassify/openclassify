<?php

return [
    'mode'          => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'dropdown',
            'options'       => [
                'dropdown' => 'anomaly.field_type.language::config.mode.option.dropdown',
                'search'   => 'anomaly.field_type.language::config.mode.option.search',
            ],
        ],
    ],
    'top_options'   => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.language',
    ],
];
