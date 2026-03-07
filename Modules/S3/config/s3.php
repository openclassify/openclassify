<?php

return [
    'default_driver' => env('MEDIA_DISK', env('FILESYSTEM_DISK', 's3')),
    'local_disk' => env('LOCAL_MEDIA_DISK', 'public'),
    'cloud_disk' => env('CLOUD_MEDIA_DISK', 's3'),
];
