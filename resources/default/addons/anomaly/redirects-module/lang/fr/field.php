<?php

return [
    'from'   => [
        'name'         => 'De',
        'label'        => 'Depuis',
        'placeholder'  => 'foo/bar/{var}',
        'instructions' => 'Entrez un chemin exact ou un motif. Par exemple <strong>foo/bar/{var}</strong> ou <strong>foo/bar</strong>.',
    ],
    'to'     => [
        'name'         => 'Vers',
        'label'        => 'Vers',
        'placeholder'  => 'bar/{var}',
        'instructions' => 'Entrez un chemin exact, un motif ou une URL complète. Par exemple <strong>bar/{var}</strong> ou <strong>bar/baz</strong>.',
    ],
    'status' => [
        'name'         => 'Statut',
        'instructions' => 'Quel type de redirection ?',
        'option'       => [
            '301' => '301 - Redirection permanente',
            '302' => '302 - Redirection temporaire',
        ],
    ],
    'secure' => [
        'name'         => 'Securisée',
        'label'        => 'Rediriger vers une URL "https" ?',
        'instructions' => 'Souhaitez-vous forcer vers une URL sécurisée ?',
    ],
];
