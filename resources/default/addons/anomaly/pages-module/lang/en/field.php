<?php

return [
    'title'            => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive name for this page.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types' => 'The slug is used in making the database table for pages of this type.',
            'pages' => 'The slug is used in building the page\'s URL.',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The page title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'name'             => [
        'name'         => 'Name',
        'instructions' => 'Specify a short descriptive name for this page type.',
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe this page type.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Specify the theme layout to wrap the <strong>page layout</strong> with.',
    ],
    'layout'           => [
        'name'         => 'Page Layout',
        'instructions' => 'The layout is used for displaying the page\'s content.',
    ],
    'allowed_roles'    => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles can access this page.',
        'warning'      => 'If no roles are specified then everyone can access this page.',
    ],
    'visible'          => [
        'name'         => 'Visible',
        'label'        => 'Display this page in navigation?',
        'instructions' => 'Disable to hide this page from page based navigation <strong>structure</strong>.',
        'warning'      => 'This may or may not have an effect depending on how your website was built.',
    ],
    'exact'            => [
        'name'         => 'Exact URI',
        'label'        => 'Require an exact URI match?',
        'instructions' => 'Disable to allow custom parameters following the URI for this page.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => 'Is this page enabled?',
        'instructions' => 'If disabled, you can still access a secure preview link in the control panel.',
        'warning'      => 'This page must be enabled before it can be viewed <strong>publicly</strong>.',
    ],
    'publish_at'       => [
        'name'         => 'Publish Date/Time',
        'instructions' => 'Specify the publish date/time for this page.',
        'warning'      => 'If set to the future, this page will not be visible until then.',
    ],
    'home'             => [
        'name'         => 'Home Page',
        'label'        => 'Is this the home page?',
        'instructions' => 'The home page is the default landing page for your website.',
    ],
    'parent'           => [
        'name'         => 'Parent Page',
        'instructions' => 'Specify a parent page to organize it within the parent\'s URI structure.',
    ],
    'handler'          => [
        'name'         => 'Handler',
        'instructions' => 'The page handler is responsible for building the entire HTTP response for a page.',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'live'      => 'Live',
            'draft'     => 'Draft',
            'scheduled' => 'Scheduled',
        ],
    ],
    'content'          => [
        'name' => 'Content',
    ],
    'path'             => [
        'name' => 'Path',
    ],
    'type'             => [
        'name' => 'Type',
    ],
    'route_name'       => [
        'name'         => 'Route Name',
        'instructions' => 'This is the page\'s immutable route name.',
    ],
];
