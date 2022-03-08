<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'search'   => 'Search',
            'dropdown' => 'Dropdown',
        ],
    ],
    'top_options'   => [
        'name'         => 'Top Options',
        'instructions' => 'Enter the ISO codes for languages that should be moved to the top. Enter each code on a new line.',
        'placeholder'  => "en\nes\nfr",
    ],
    'default_value' => [
        'name'         => 'Default Value',
        'instructions' => 'Select a default language if any.',
    ],
];
