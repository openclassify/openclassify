<?php

return [
    'sidebar_hover' => 'anomaly.field_type.boolean',
    'navigation'    => [
        'type'       => 'anomaly.field_type.textarea',
        'input_view' => 'pyrocms.theme.accelerant::admin/navigation/preferences',
    ],
    'display'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'default',
            'mode'          => 'dropdown',
            'options'       => [
                'default' => 'pyrocms.theme.accelerant::preference.display.option.default',
                'compact' => 'pyrocms.theme.accelerant::preference.display.option.compact',
            ],
        ],
    ],
    'sidebars'      => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options'       => [
                'default' => 'pyrocms.theme.accelerant::preference.sidebars.option.default',
                'static'  => 'pyrocms.theme.accelerant::preference.sidebars.option.static',
            ],
            'default_value' => 'default',
            'mode'          => 'dropdown',
        ],
    ],
];
