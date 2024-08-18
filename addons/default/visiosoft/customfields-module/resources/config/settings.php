<?php

return [
    'openFilter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            "mode" => "radio",
        ],
    ],
    'openTextFilter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            "mode" => "radio",
        ],
    ],
    'openDateFilter' => [
        'type' => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
];
