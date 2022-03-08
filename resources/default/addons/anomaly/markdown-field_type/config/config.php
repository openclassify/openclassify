<?php

return [
    'height' => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 300,
            'min'           => 200,
            'step'          => 50,
        ],
    ],
];
