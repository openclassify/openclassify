<?php

return [
    'folders' => [
        'name'         => 'Folders',
        'instructions' => 'Specify which folders are available for this field. Leave blank to display all folders.',
        'warning'      => 'Existing folder permissions take precedence over selected folders.',
    ],
    'min'     => [
        'label'        => 'Minimum Selections',
        'instructions' => 'Enter the minimum number of allowed selections.',
    ],
    'max'     => [
        'label'        => 'Taille maximale',
        'instructions' => 'Entrez la taille maximale par fichier en <strong>méga-octets</strong>.<br>La taille par défaut et la taille maximale sont la taille maximale autorisée par le serveur.',
    ],
    'mode'    => [
        'name'         => 'Input Mode',
        'instructions' => 'How should users provide file input?',
        'option'       => [
            'default' => 'Upload and/or select files.',
            'select'  => 'Select files only.',
            'upload'  => 'Upload files only.',
        ],
    ],
];
