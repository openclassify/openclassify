<?php

return [
    'type' => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                'text'     => 'anomaly.field_type.text::config.type.option.text',
                'email'    => 'anomaly.field_type.text::config.type.option.email',
                'textarea' => 'anomaly.field_type.text::config.type.option.textarea',
            ],
        ],
    ],
    'min'  => [
        'type' => 'anomaly.field_type.integer',
    ],
    'max'  => [
        'type' => 'anomaly.field_type.integer',
    ],
];
