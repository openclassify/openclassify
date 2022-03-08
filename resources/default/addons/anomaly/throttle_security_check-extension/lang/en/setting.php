<?php

return [
    'max_attempts'      => [
        'label'        => 'Allowed Login Attempts',
        'instructions' => 'How many failed login attempts are allowed within the <strong>Throttle Interval</strong>?',
    ],
    'throttle_interval' => [
        'label'        => 'Throttle Interval',
        'instructions' => 'If the <strong>Allowed Login Attempts</strong> is reached within the specified number of minutes, lockout the user.',
    ],
    'lockout_interval'  => [
        'label'        => 'Lockout Interval',
        'instructions' => 'Specify how many minutes a throttled user is locked out before they can attempt to login again.',
    ],
];
