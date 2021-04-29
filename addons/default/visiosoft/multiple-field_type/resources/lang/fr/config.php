<?php

return [
    'related'    => [
        'label'        => 'Flux associé',
        'instructions' => 'Spécifiez les entrées de flux associées à afficher dans la liste déroulante.',
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
        'label'        => 'Sélections minimales',
        'instructions' => 'Spécifiez le nombre minimum de sélections autorisées.',
    ],
    'max'        => [
        'label'        => 'Taille maximale',
        'instructions' => 'Spécifiez le nombre maximum de sélections autorisées.',
    ],
    'title_name' => [
        'label'        => 'Champ de titre',
        'placeholder'  => 'Prénom',
        'instructions' => 'Spécifiez le <strong>slug</strong> du champ à afficher pour les options de liste déroulante / de recherche.<br>Vous pouvez spécifier des titres analysables tels que <strong>{entry.first_name} {entry.last_name}</strong><br>La colonne de titre du flux associé sera utilisée par défaut.',
    ],
];
