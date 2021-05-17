<?php

return [
    'related'    => [
        'label'        => 'Related Stream',
        'instructions' => 'Specify the related stream entries to display in the dropdown.',
    ],
    'mode'       => [
        'label'  => 'Mod unosa',
        'option' => [
            'tags'       => 'Tags',
            'lookup'     => 'Lookup',
            'checkboxes' => 'Checkboxes',
        ],
    ],
    'min'        => [
        'label'        => 'Minimalni odabir',
        'instructions' => 'Specify the minimum number of allowed selections.',
    ],
    'max'        => [
        'label'        => 'Maksimalni odabir',
        'instructions' => 'Specify the maximum number of allowed selections.',
    ],
    'title_name' => [
        'label'        => 'Title Field',
        'placeholder'  => 'first_name',
        'instructions' => 'Specify the <strong>slug</strong> of field to display for dropdown/search options.<br>You can specify parsable titles like <strong>{entry.first_name} {entry.last_name}</strong><br>The related stream\'s title column will be used by default.',
    ],
];
