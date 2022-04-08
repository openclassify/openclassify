<?php

return [
    'type'       => [
        'label'        => 'Type d\'addon',
        'instructions' => 'Quel type d\'addon souhaitez-vous utiliser ?',
        'placeholder'  => 'Tout les types',
    ],
    'search'     => [
        'label'        => 'Chercher dans les extensions',
        'instructions' => 'Si le type d\'addon "Extensions" est sélectionné, vous pouvez ajouter un paramètre de recherche pour retourner uniquement les extensions proposant un service en particulier.',
        'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'        => 'Type de thème',
        'instructions' => 'Si le type d\'addon "Thèmes" est sélectionné, vous pouvez limiter la recherche aux thèmes "Admin" ou "Public".',
        'placeholder'  => 'Admin + Public',
        'admin'        => 'Admin',
        'public'       => 'Public',
    ],
];
