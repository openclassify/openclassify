<?php

use Visiosoft\MultipleFieldType\Support\Config\RelatedHandler;

return [
    'related'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'handler' => RelatedHandler::class,
        ],
    ],
    'mode'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options' => [
                'tags'       => 'visiosoft.field_type.multiple::config.mode.option.tags',
                'lookup'     => 'visiosoft.field_type.multiple::config.mode.option.lookup',
                'checkboxes' => 'visiosoft.field_type.multiple::config.mode.option.checkboxes',
            ],
        ],
    ],
    'title_name' => [
        'type' => 'anomaly.field_type.text',
    ],
    'min'        => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'        => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
];
