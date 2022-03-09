<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'switch'   => 'Switch',
            'checkbox' => 'Checkbox',
            'dropdown' => 'Dropdown',
            'radio'    => 'Radio Buttons',
        ],
    ],
    'label'         => [
        'label'        => 'Choice Label',
        'instructions' => 'This label is displayed right next to the input.',
    ],
    'on_text'       => [
        'label'        => '"On" Text',
        'instructions' => 'This text will be used for the switch\'s "on" state.',
        'placeholder'  => 'YES',
    ],
    'on_color'      => [
        'label'        => '"On" Color',
        'instructions' => 'This color will be used for the switch\'s "on" state.',
        'option'       => [
            'green'  => 'Green',
            'blue'   => 'Blue',
            'orange' => 'Orange',
            'red'    => 'Red',
            'gray'   => 'Gray',
        ],
    ],
    'off_text'      => [
        'label'        => '"Off" Text',
        'instructions' => 'This text will be used for the switch\'s "off" state.',
        'placeholder'  => 'NO',
    ],
    'off_color'     => [
        'label'        => '"Off" Color',
        'instructions' => 'This color will be used for the switch\'s "off" state.',
        'option'       => [
            'green'  => 'Green',
            'blue'   => 'Blue',
            'orange' => 'Orange',
            'red'    => 'Red',
            'gray'   => 'Gray',
        ],
    ],
    'default_value' => [
        'label'        => 'Default State',
        'instructions' => 'What is the default state of the switch?',
        'option'       => [
            'on'  => 'ON',
            'off' => 'OFF',
        ],
    ],
];
