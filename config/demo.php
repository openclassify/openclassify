<?php

return [
    'enabled' => (bool) env('DEMO', false),
    'provisioning' => false,
    'ttl_minutes' => (int) env('DEMO_TTL_MINUTES', 360),
    'schema_prefix' => env('DEMO_SCHEMA_PREFIX', 'demo_'),
    'cookie_name' => env('DEMO_COOKIE_NAME', 'oc2_demo'),
    'login_email' => env('DEMO_LOGIN_EMAIL', 'a@a.com'),
    'public_schema' => env('DEMO_PUBLIC_SCHEMA', 'public'),
];
