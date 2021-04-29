<?php

return [
    'related'    => [
        'label'        => 'Stream en relation',
        'instructions' => 'Choisissez les entrées à afficher dans la sélection.',
    ],
    'mode'       => [
        'label'  => 'Mode d\'entrée',
        'option' => [
            'tags'       => 'Mots clés',
            'lookup'     => 'Chercher',
            'checkboxes' => 'Cases à cocher',
        ],
    ],
    'min'        => [
        'label'        => 'Nombre de sélection minimum',
        'instructions' => 'Entrez un nombre minimum de sélection.',
    ],
    'max'        => [
        'label'        => 'Nombre de sélection maximum',
        'instructions' => 'Entrez un nombre maximum de sélection.',
    ],
    'title_name' => [
        'label'        => 'Champ de titre',
        'placeholder'  => 'Prénom',
        'instructions' => 'Spécifiez le <strong>slug</strong> du champ à afficher pour les options de liste déroulante / de recherche.<br>Vous pouvez spécifier des titres analysables tels que <strong>{entry.first_name} {entry.last_name}</strong><br>La colonne de titre du flux associé sera utilisée par défaut.',
    ],
];
