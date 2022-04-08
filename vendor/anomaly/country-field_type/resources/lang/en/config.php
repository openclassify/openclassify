<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'input'    => 'Text Input',
            'dropdown' => 'Dropdown',
            'search'   => 'Search',
        ],
    ],
    'top_options'   => [
        'name'         => 'Top Options',
        'instructions' => 'Enter the ISO Alpha-2 codes for countries that should be moved to the top. Enter each code on a new line.',
        'placeholder'  => "US\nCA\nMX",
    ],
    'default_value' => [
        'name'         => 'Default Value',
        'instructions' => 'Select a default country if any.',
    ],
];
