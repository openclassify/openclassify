<?php

return [
    'notify' => [
        'name'   => 'Ilmoittaa',
        'option' => [
            'read'   => 'Voi lukea ilmoituksen?',
            'write'  => 'Voi luoda / muokata ilmoitusta?',
            'delete' => 'Voinko poistaa ilmoituksen?',
        ],
    ],
    'smsnotify' => [
        'name'   => 'Tekstiviesti',
        'option' => [
            'read'   => 'Voi lukea SMS-ilmoitusta?',
            'write'  => 'Voiko luoda / muokata SMS-ilmoitusta?',
            'delete' => 'Voiko smsnotify poistaa?',
        ],
    ],
    'template' => [
        'name'   => 'Sapluuna',
        'option' => [
            'read'   => 'Voi lukea mallia?',
            'write'  => 'Voiko luoda / muokata mallia?',
            'delete' => 'Voinko poistaa mallin?',
        ],
    ],
];
