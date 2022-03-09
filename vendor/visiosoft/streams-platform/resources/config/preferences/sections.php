<?php

return [
    'display' => [
        'context' => 'info',
        'title'   => 'streams::label.display',
        'fields'  => [
            'per_page'
        ]
    ],
    'formats' => [
        'context' => 'danger',
        'title'   => 'streams::label.formats',
        'fields'  => [
            'timezone',
            'date_format',
            'time_format'
        ]
    ]
];
