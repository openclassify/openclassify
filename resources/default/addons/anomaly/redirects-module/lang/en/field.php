<?php

return [
    'from'   => [
        'name'         => 'From',
        'label'        => 'Redirect From',
        'placeholder'  => [
            'redirects' => 'foo/bar/{var}',
            'domains'   => 'olddomain.com',
        ],
        'instructions' => [
            'redirects' => 'Specify an exact path or pattern to redirect. For example <strong>foo/bar/{var}</strong> or <strong>foo/bar</strong>.',
            'domains'   => 'Specify the domain to redirect. Include any prefix and a port if not standard.',
        ],
        'warning'      => [
            'redirects' => 'Do not include locale hints like <strong>en</strong>/foo/bar/{var}',
            'domains'   => 'Do not include any path information.',
        ],
    ],
    'to'     => [
        'name'         => 'To',
        'label'        => 'Redirect To',
        'placeholder'  => [
            'redirects' => 'bar/{var}',
            'domains'   => 'newdomain.com',
        ],
        'instructions' => [
            'redirects' => 'Specify an exact path, pattern replacement or URL to redirect to. For example <strong>bar/{var}</strong> or <strong>bar/baz</strong>',
            'domains'   => 'Specify the domain to redirect to. Include any prefix and a port if not standard.',
        ],
        'warning'      => [
            'domains' => 'Leave blank to use the configured primary domain: <strong>' . config(
                    'streams::system.domain'
                ) . '</strong>',
        ],
    ],
    'status' => [
        'name'         => 'Status',
        'instructions' => 'What kind of redirect is this?',
        'option'       => [
            '301' => '301 - Permanent Redirect',
            '302' => '302 - Temporary Redirect',
        ],
    ],
    'secure' => [
        'name'         => 'Secure',
        'label'        => 'Redirect to a secure URL?',
        'instructions' => 'Do you want to force a secure connection when redirecting?',
        'warning'      => 'This option is ignored if a protocol is included in the <strong>Redirect To</strong> value.',
    ],
];
