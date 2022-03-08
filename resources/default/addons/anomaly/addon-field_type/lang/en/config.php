<?php

return [
    'type'       => [
        'label'        => 'Addon Type',
        'instructions' => 'What type of addons would you like to include?',
        'placeholder'  => 'All Addons',
    ],
    'mode'       => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'search'   => 'Search',
            'dropdown' => 'Dropdown',
        ],
    ],
    'search'     => [
        'label'        => 'Search Extensions',
        'instructions' => 'If the "Extensions" addon type is selected, you can define an optional search parameter here to return only extensions providing a specific service.',
        'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'        => 'Theme Type',
        'instructions' => 'If the "Themes" addon type is selected, you can optional limit themes to admin or public themes only.',
        'placeholder'  => 'Admin + Public',
        'admin'        => 'Admin',
        'public'       => 'Public',
    ],
];
