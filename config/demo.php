<?php

declare(strict_types=1);

return [
    'enabled' => (bool) env('DEMO', false),
    'provisioning' => false,
    'ttl_minutes' => (int) env('DEMO_TTL_MINUTES', 360),
    'schema_prefix' => env('DEMO_SCHEMA_PREFIX', 'demo_'),
    'cookie_name' => env('DEMO_COOKIE_NAME', 'oc2_demo'),
    'login_email' => env('DEMO_LOGIN_EMAIL', 'a@a.com'),
    'user_password' => env('DEMO_USER_PASSWORD'),
    'max_concurrent_instances' => (int) env('DEMO_MAX_CONCURRENT_INSTANCES', 25),
    'public_schema' => env('DEMO_PUBLIC_SCHEMA', 'public'),
    'turnstile' => [
        'enabled' => (bool) env('DEMO_TURNSTILE_ENABLED', false),
        'site_key' => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
        'verify_url' => env('TURNSTILE_VERIFY_URL', 'https://challenges.cloudflare.com/turnstile/v0/siteverify'),
        'timeout_seconds' => (int) env('TURNSTILE_TIMEOUT_SECONDS', 8),
    ],
];
