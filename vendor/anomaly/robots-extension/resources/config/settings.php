<?php

return [
    'content' => [
        'type'   => 'anomaly.field_type.editor',
        'config' => [
            'mode'          => 'twig',
            'default_value' => file_get_contents(__DIR__ . '/../views/robots.twig')
        ]
    ]
];
