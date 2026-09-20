<?php

declare(strict_types=1);

return [
    'active' => env('OC_THEME', 'default'),
    'modules' => [
        'listing' => env('OC_THEME_LISTING', 'default'),
        'category' => env('OC_THEME_CATEGORY', 'default'),
    ],
];
