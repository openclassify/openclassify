<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => [
            'disks'   => 'Geben Sie einen kurzen aussagekräftigen Namen für die Disk an.',
            'folders' => 'Geben Sie einen kurzen aussagekräftigen Namen für den Ordner an.',
            'files'   => 'Geben Sie den Namen für die Datei an.',
        ],
    ],
    'title'         => [
        'name'         => 'Titel',
        'instructions' => 'Geben Sie einen kurzen aussagekräftigen Titel für diese Datei an.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Die Slug wird verwendet um den Speicherort zu erstellen',
    ],
    'size'          => [
        'name' => 'Größe',
    ],
    'disk'          => [
        'name'         => 'Disk',
        'instructions' => 'Wählen Sie zu welcher Disk dieser Ordner gehört.',
    ],
    'folder'        => [
        'name' => 'Ordner',
    ],
    'adapter'       => [
        'name' => 'Adapter',
    ],
    'keywords'      => [
        'name'         => 'Schlagewörter',
        'instructions' => 'Geben Sie organisatorische Schlagwörter an, um die Gruppierung Ihres Dateien zu erleichtern.',
    ],
    'mime_type'     => [
        'name' => 'MIME Type',
    ],
    'preview'       => [
        'name' => 'Vorschau',
    ],
    'description'   => [
        'name'         => 'Beschreibung',
        'instructions' => [
            'disks'  => 'Geben Sie eine kurze Bescheibung dieser Disk an.',
            'folder' => 'Geben Sie eine kurze Bescheibung dieses Ordners an.',
            'files'  => 'Geben Sie eine kurze Bescheibung dieser Datei an.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'Erlaubte Typen',
        'instructions' => 'Geben Sie die Dateityp Erweiterungen an, die für diesen Ordner erlaubt sind.',
        'warning'      => 'Beachten Sie subtile Unterschiede zwischen MIME Typen wie jpg und jpeg',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
    'alt_text'      => [
        'name'         => 'Alt Text',
        'instructions' => 'Geben Sie den Alternativtext für ein Bild an.',
        'warning'      => 'Der menschenlesbare Dateiname wird üblicherweise als Fallback verwendet.',
    ],
    'caption'       => [
        'name'         => 'Bildüberschrift',
        'instructions' => 'Geben Sie einen begleitenden Text für ein Bild an.',
    ],
];
