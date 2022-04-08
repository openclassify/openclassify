<?php

return [
    'blocks' => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => \Anomaly\BlocksFieldType\Support\Config\BlocksHandler::class,
        ],
    ],
    'min'    => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'    => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
];
