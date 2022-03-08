<?php

return [
    'max_upload_size'      => [
        'name'         => 'Maximum Upload Size',
        'instructions' => 'Specify the maximum file size for uploads.',
        'warning'      => 'Your server\'s max upload size is currently ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximum Parallel Uploads',
        'instructions' => 'Specify the maximum number of files that can be uploaded at the same time.',
    ],
];
