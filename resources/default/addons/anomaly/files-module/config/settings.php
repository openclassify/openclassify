<?php

return [
    'max_upload_size'      => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => max_upload_size(),
            'max'           => max_upload_size(),
            'min'           => 1,
        ],
    ],
    'max_parallel_uploads' => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 1,
            'min'           => 1,
        ],
    ],
];
