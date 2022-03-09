<?php

use Anomaly\EditorFieldType\Support\Config\ModeHandler;

return [
    'mode'          => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'handler' => ModeHandler::class,
        ],
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'height'        => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 75,
            'min'           => 50,
            'step'          => 25,
        ],
    ],
    'word_wrap'     => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options'       => [
                'yes' => 'streams::misc.yes',
                'no'  => 'streams::misc.no',
            ],
            'default_value' => 'yes',
        ],
    ],

];
