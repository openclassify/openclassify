<?php


return [
    'folders' => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => \Anomaly\FileFieldType\Support\Config\FoldersHandler::class,
        ],
    ],
    'max'     => [
        'type'   => 'anomaly.field_type.decimal',
        'config' => [
            'decimals' => 1,
        ],
    ],
    'mode'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options' => [
                'default' => 'anomaly.field_type.file::config.mode.option.default',
                'select'  => 'anomaly.field_type.file::config.mode.option.select',
                'upload'  => 'anomaly.field_type.file::config.mode.option.upload',
            ],
        ],
    ],
    'allowed_types' => [
        'type' => 'anomaly.field_type.tags',
    ],
];
