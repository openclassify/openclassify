<?php

return [
    'max_upload_size'      => [
        'name'         => 'Maximale Upload Grootte',
        'instructions' => 'Specificeer de maximale bestandsgrootte voor uploads.',
        'warning'      => 'Je server\'s max upload grootte is nu ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximale Parallelle Uploads',
        'instructions' => 'Specificeer het maximale aantal bestanden dat tegelijk geüpload kan worden.',
    ],
];
