<?php

return [
    'folders' => [
        'name'         => 'Folders',
        'instructions' => 'Specify which folders are available for this field. Leave blank to display all folders.',
        'warning'      => 'Existing folder permissions take precedence over selected folders.',
    ],
    'max'     => [
        'name'         => 'Max Upload Size',
        'instructions' => 'Entrez la taille maximale du fichier en <strong>méga-octets</strong>.<br>La taille par défaut et la taille maximale sont la taille maximale autorisée par le serveur.',
        'warning'      => 'If not specified the folder max and then server max will be used instead.',
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
