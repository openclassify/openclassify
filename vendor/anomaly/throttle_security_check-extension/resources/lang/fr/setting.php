<?php

return [
    'max_attempts'      => [
        'label'        => 'Tentatives de connexion échouées autorisées',
        'instructions' => 'Combien de tentatives de connexion échouées sont autorisées durant <strong>l\'intervale de sécurité</strong> ?',
    ],
    'throttle_interval' => [
        'label'        => 'Intervale de sécurité',
        'instructions' => 'Bloque l\'utilisateur si le nombre de <strong>tentatives de connexion échouées</strong> est atteint durant ce nombre de minute.',
    ],
    'lockout_interval'  => [
        'label'        => 'Durée du blocage',
        'instructions' => 'Choisissez le nombre de minute pendant lequel l\'utilisateur ne peut plus se connecter après avoir été bloqué.',
    ],
];
