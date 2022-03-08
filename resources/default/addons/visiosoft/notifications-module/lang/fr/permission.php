<?php

return [
    'notify' => [
        'name'   => 'Notifier',
        'option' => [
            'read'   => 'Peut lire les notifications ?',
            'write'  => 'Peut créer / modifier une notification?',
            'delete' => 'Peut-on supprimer la notification ?',
        ],
    ],
    'smsnotify' => [
        'name'   => 'Notification SMS',
        'option' => [
            'read'   => 'Peut lire les notifications  sms ?',
            'write'  => 'Peut créer / modifier  les notifications sms?',
            'delete' => 'Peut-on supprimer la notification sms ?',
        ],
    ],
    'template' => [
        'name'   => 'Modèle',
        'option' => [
            'read'   => 'Peut lire le modèle?',
            'write'  => 'Peut créer / modifier un modèle?',
            'delete' => 'Peut supprimer le modèle?',
        ],
    ],
];
