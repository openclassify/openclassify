<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'search'   => 'Search',
            'buttons'  => 'Buttons',
            'dropdown' => 'Dropdown',
            'radio'    => 'Radio Buttons',
        ],
    ],
    'options'       => [
        'label'        => 'Options',
        'instructions' => 'Enter options below in a <strong>key: Value</strong> or <strong>Value</strong> only format. Enter each option on a new line.',
        'placeholder'  => 'key: Value',
    ],
    'default_value' => [
        'label'        => 'Default Value',
        'instructions' => 'Enter the default value if any.',
    ],
    'separator'     => [
        'label'        => 'Separator',
        'instructions' => 'Specify a custom <strong>key:value</strong> separator if needed.',
        'placeholder'  => ':',
    ],
];
