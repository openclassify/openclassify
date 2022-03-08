<?php

return [
    'max_upload_size'      => [
        'name'         => 'Taille maximale d\'envoi',
        'instructions' => 'Choisissez la taille maximale des fichiers envoyés.',
        'warning'      => 'La taille maximale autorisée par votre serveur est : ' . max_upload_size() . ' Mo',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Nombre d\'envois simultanés',
        'instructions' => 'Choisissez le nombre maximum d\'envoi possible en même temps.',
    ],
];
