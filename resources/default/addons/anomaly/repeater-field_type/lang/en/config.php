<?php

return [
    'related' => [
        'label'        => 'Repeater',
        'instructions' => 'Specify the related <a href="' . url(
                'admin/repeaters'
            ) . '" target="_blank">repeater</a>.',
    ],
    'add_row' => [
        'label'        => 'Add Row',
        'instructions' => 'Specify custom text for the "Add Row" button.',
        'placeholder'  => 'Add Row',
    ],
    'min'     => [
        'label'        => 'Minimum Items',
        'instructions' => 'Specify the minimum number of allowed items.',
    ],
    'max'     => [
        'label'        => 'Maximum Items',
        'instructions' => 'Specify the maximum number of allowed items.',
    ],
    'repeater_title' => [
        'label'        => 'Repeater Title',
        'instructions' => 'The title field to use for populating repeater titles from existing entries.',
    ],
];
