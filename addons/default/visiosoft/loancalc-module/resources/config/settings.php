<?php

return [
    'interest_rate' => [
        'type' => 'anomaly.field_type.decimal',
        'required' => true,
        'config' => [
            'default_value' => 1.98,
        ],
    ],
    'advance_payment_percentage' => [
        'type' => 'anomaly.field_type.decimal',
        'required' => true,
        'config' => [
            'default_value' => 0.3,
        ],
    ],
    'show_in_categories' => [
        'type' => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => 'Visiosoft\LoancalcModule\SettingHandler\CategoriesOptions@handle'
        ],
    ],
];
