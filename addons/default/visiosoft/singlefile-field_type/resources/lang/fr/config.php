<?php

return [
    'folders' => [
        'name'         => 'Dossiers',
        'instructions' => 'Spécifiez les dossiers disponibles pour ce champ. Laissez vide pour afficher tous les dossiers.',
        'warning'      => 'Les autorisations de dossier existantes ont priorité sur les dossiers sélectionnés.',
    ],
    'max'     => [
        'name'         => 'Taille de téléchargement maximale',
        'instructions' => 'Entrez la taille maximale du fichier en <strong>méga-octets</strong>.<br>La taille par défaut et la taille maximale sont la taille maximale autorisée par le serveur.',
        'warning'      => 'S\'il n\'est pas spécifié, le dossier max puis le serveur max seront utilisés à la place.',
    ],
    'mode'    => [
        'name'         => 'Mode d\'entrée',
        'instructions' => 'Comment les utilisateurs doivent-ils fournir une entrée de fichier?',
        'option'       => [
            'default' => 'Téléchargez et / ou sélectionnez des fichiers.',
            'select'  => 'Sélectionnez uniquement les fichiers.',
            'upload'  => 'Téléchargez uniquement des fichiers.',
        ],
    ],
];
