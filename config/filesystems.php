<?php

return [
    'default' => env('FILESYSTEM_DISK', env('MEDIA_DISK', 's3')),
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_PUBLIC_STORAGE_URL', '/storage'),
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID', env('OBJECT_STORAGE_ACCESS_KEY_ID')),
            'secret' => env('AWS_SECRET_ACCESS_KEY', env('OBJECT_STORAGE_SECRET_ACCESS_KEY')),
            'region' => env('AWS_DEFAULT_REGION', env('OBJECT_STORAGE_REGION', 'hel1')),
            'bucket' => env('AWS_BUCKET', env('OBJECT_STORAGE_BUCKET')),
            'url' => env('AWS_URL', env('OBJECT_STORAGE_URL')),
            'endpoint' => env('AWS_ENDPOINT', env('OBJECT_STORAGE_ENDPOINT')),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

    ],
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
