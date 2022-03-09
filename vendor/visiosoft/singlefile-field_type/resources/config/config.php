<?php

use Visiosoft\SinglefileFieldType\Support\Config\FoldersHandler;

return [
    'folders' => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => FoldersHandler::class,
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
                'default' => 'visiosoft.field_type.singlefile::config.mode.option.default',
                'select'  => 'visiosoft.field_type.singlefile::config.mode.option.select',
                'upload'  => 'visiosoft.field_type.singlefile::config.mode.option.upload',
            ],
        ],
    ],
];
