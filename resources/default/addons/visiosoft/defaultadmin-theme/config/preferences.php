<?php

return [
    'sidebar_hover' => 'anomaly.field_type.boolean',
    'navigation'    => [
        'type'       => 'anomaly.field_type.textarea',
        'input_view' => 'visiosoft.theme.defaultadmin::admin/navigation/preferences',
    ],
    'display'       => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'default_value' => 'default',
            'mode'          => 'dropdown',
            'options'       => [
                'default' => 'visiosoft.theme.defaultadmin::preference.display.option.default',
                'compact' => 'visiosoft.theme.defaultadmin::preference.display.option.compact',
            ],
        ],
    ],
    'sidebars'      => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options'       => [
                'default' => 'visiosoft.theme.defaultadmin::preference.sidebars.option.default',
                'static'  => 'visiosoft.theme.defaultadmin::preference.sidebars.option.static',
            ],
            'default_value' => 'default',
            'mode'          => 'dropdown',
        ],
    ],
];
