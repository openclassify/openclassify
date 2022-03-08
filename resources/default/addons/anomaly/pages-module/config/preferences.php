<?php

return [
    'page_view' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'tree'  => 'anomaly.module.pages::preferences.page_view.option.tree',
                'table' => 'anomaly.module.pages::preferences.page_view.option.table',
            ],
        ],
    ],
];
