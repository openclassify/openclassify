<?php

return [
    'buttons'          => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => \Anomaly\WysiwygFieldType\Support\Config\ButtonsHandler::class,
        ],
    ],
    'plugins'          => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => \Anomaly\WysiwygFieldType\Support\Config\PluginsHandler::class,
        ],
    ],
    'height'           => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'step' => 25,
            'min'  => 75,
        ],
    ],
    'line_breaks'      => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => config('anomaly.field_type.wysiwyg::redactor.line_breaks', false),
        ],
    ],
    'remove_new_lines' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => config('anomaly.field_type.wysiwyg::redactor.remove_new_lines', false),
        ],
    ],
    'default_value'    => [
        'type' => 'anomaly.field_type.wysiwyg',
    ],
];
