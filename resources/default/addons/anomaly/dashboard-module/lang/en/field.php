<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => 'Specify a short descriptive name for this dashboard.',
    ],
    'title'         => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive title for this widget.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug is used in the dashboard URL.',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => [
            'dashboards' => 'Briefly describe this dashboard.',
            'widgets'    => 'Briefly describe this widget.',
        ],
    ],
    'layout'        => [
        'name'         => 'Layout',
        'instructions' => 'The layout determines how you can organize dashboard widgets.',
        'option'       => [
            '24'      => 'Single column',
            '12-12'   => 'Two equal columns',
            '16-8'    => 'Two columns - left weighted',
            '8-16'    => 'Two columns - right weighted',
            '8-8-8'   => 'Three equal columns',
            '6-12-6'  => 'Three columns - center weighted',
            '12-6-6'  => 'Three columns - left weighted',
            '6-6-12'  => 'Three columns - right weighted',
            '6-6-6-6' => 'Four equal columns',
        ],
    ],
    'dashboard'     => [
        'name'         => 'Dashboard',
        'instructions' => 'Choose which dashboard this widget belongs to.',
    ],
    'extension'     => [
        'name' => 'Extension',
    ],
    'pinned'        => [
        'name'         => 'Pinned',
        'label'        => 'Pin this widget?',
        'instructions' => 'Pinned widgets are full width and pushed to the top of the dashboard.',
    ],
    'allowed_roles' => [
        'name'         => 'Allowed Roles',
        'instructions' => [
            'dashboards' => 'Specify which user roles can access this dashboard.',
            'widgets'    => 'Specify which user roles can see this widget.',
        ],
        'warning'      => [
            'dashboards' => 'If no roles are specified then everyone with access to this addon can access this dashboard.',
            'widgets'    => 'If no roles are specified then everyone with access to this addon can see this widget.',
        ],
    ],
];
