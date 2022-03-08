<?php

return [
    'mode'          => [
        'label'  => 'Input Mode',
        'option' => [
            'checkboxes' => 'Checkboxes',
            'tags'       => 'Tags',
        ],
    ],
    'options'       => [
        'label'        => 'Options',
        'instructions' => 'Enter options below in a <strong>key: Value</strong> or <strong>Value</strong> only format. Enter each option on a new line.',
        'placeholder'  => 'key: Value',
    ],
    'min'           => [
        'label'        => 'Minimum Selections',
        'instructions' => 'Enter the minimum number of allowed selections.',
    ],
    'max'           => [
        'label'        => 'Maximum Selections',
        'instructions' => 'Enter the maximum number of allowed selections.',
    ],
    'default_value' => [
        'label'        => 'Default Value',
        'instructions' => 'Enter the default selections.',
    ],
    'separator'     => [
        'label'        => 'Separator',
        'instructions' => 'Specify a custom <strong>key:value</strong> separator if needed.',
        'placeholder'  => ':',
    ],
];
