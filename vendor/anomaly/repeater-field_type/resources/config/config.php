<?php

return [
    'related' => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'handler' => \Anomaly\RepeaterFieldType\Support\Config\RelatedHandler::class,
        ],
    ],
    'add_row' => [
        'type' => 'anomaly.field_type.text',
    ],
    'min'     => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'     => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'repeater_title' => [
        'type' => 'anomaly.field_type.text',
    ],
];
