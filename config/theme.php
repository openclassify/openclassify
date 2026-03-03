<?php

return [
    'active' => env('TALLCMS_THEME_ACTIVE', 'talldaisy'),
    'themes_path' => base_path('themes'),
    'cache_themes' => env('TALLCMS_THEME_CACHE', true),
    'auto_discover' => true,
];
