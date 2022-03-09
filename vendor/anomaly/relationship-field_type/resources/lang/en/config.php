<?php

return [
    'related'    => [
        'label' => 'Related Stream',
    ],
    'mode'       => [
        'label'  => 'Input Mode',
        'option' => [
            'dropdown' => 'Dropdown',
            'lookup'   => 'Lookup',
            'search'   => 'Search',
        ],
    ],
    'title_name' => [
        'label'        => 'Title Field',
        'placeholder'  => 'first_name',
        'instructions' => 'Specify the <strong>slug</strong> of field to display for dropdown/search options.<br>You can specify parsable titles like <strong>{entry.first_name} {entry.last_name}</strong><br>The related stream\'s title column will be used by default.',
    ],
];
