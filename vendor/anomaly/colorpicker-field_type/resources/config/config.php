<?php

return [
    'format'        => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options' => [
                'hex'  => '#61259e',
                'rgb'  => 'rgb(97, 37, 158)',
                'rgba' => 'rgba(97, 37, 158, 1)',
            ],
        ],
    ],
    'default_value' => [
        'type'   => 'anomaly.field_type.colorpicker',
        'config' => [
            'format' => 'rgba',
        ],
    ],
];
