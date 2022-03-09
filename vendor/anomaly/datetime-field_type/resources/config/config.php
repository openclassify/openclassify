<?php

return [
    'mode'        => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                'datetime' => 'anomaly.field_type.datetime::config.mode.datetime',
                'date'     => 'anomaly.field_type.datetime::config.mode.date',
                'time'     => 'anomaly.field_type.datetime::config.mode.time',
            ],
        ],
    ],
    'picker'      => [
        'type' => 'anomaly.field_type.boolean',
    ],
    'date_format' => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'handler' => \Anomaly\DatetimeFieldType\Support\Config\DateFormatHandler::class,
        ],
    ],
    'time_format' => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'handler' => \Anomaly\DatetimeFieldType\Support\Config\TimeFormatHandler::class,
        ],
    ],
    'timezone'    => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'mode'    => 'search',
            'handler' => 'timezones',
        ],
    ],
    'step'        => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'min' => 1,
        ],
    ],
];
