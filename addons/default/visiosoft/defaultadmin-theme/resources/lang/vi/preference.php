<?php

return [
    'sidebar_hover' => [
        'name'         => 'Sidebar Hover',
        'instructions' => 'Expand the sidebar on hover?',
    ],
    'navigation'    => [
        'name'         => 'Navigation',
        'instructions' => 'Specify your <em>personal</em> order of navigation.',
        'warning'      => 'The first accessible navigation item is used as your <strong>home</strong> area.',
        'reorder'      => 'Drag and drop the primary navigation items in the <strong>sidebar</strong> to reorder them.',
    ],
    'display'       => [
        'name'         => 'Display Density',
        'instructions' => 'Compact display allows more content to be shown on the screen at once.',
        'option'       => [
            'default' => 'Default',
            'compact' => 'Compact',
        ],
    ],
    'sidebars'      => [
        'name'         => 'Sidebar Mode',
        'instructions' => 'Static sidebars will always be visible.',
        'option'       => [
            'default' => 'Default',
            'static'  => 'Static',
        ],
    ],
];
