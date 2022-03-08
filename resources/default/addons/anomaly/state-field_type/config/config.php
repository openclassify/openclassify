<?php

return [
    'mode'          => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'input',
            'options'       => [
                'input'    => 'anomaly.field_type.state::config.mode.option.input',
                'dropdown' => 'anomaly.field_type.state::config.mode.option.dropdown',
                'search'   => 'anomaly.field_type.state::config.mode.option.search',
            ],
        ],
    ],
    'countries'     => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'default_value' => [
                'US',
            ],
            'handler'       => 'countries',
            'mode'          => 'tags',
        ],
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.state',
    ],
];
