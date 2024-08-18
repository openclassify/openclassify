<?php

return [
    'users'    => [
        'name'   => 'Gebruikers',
        'option' => [
            'read'         => 'Kan gebruikers sectie lezen.',
            'write'        => 'Kan gebruikers aanmaken en wijzigen.',
            'write_admins' => 'Kan admins aanmaken en wijzigen.',
            'impersonate'  => 'Kan andere gebruikers impersonaliseren.',
            'reset'        => 'Kan gebruikers resetten.',
            'delete'       => 'Kan gebruikers verwijderen.',
        ],
    ],
    'roles'    => [
        'name'   => 'Roles',
        'option' => [
            'read'   => 'Kan bij de roles sectie komen.',
            'write'  => 'Kan roles aanmaken en wijzigen.',
            'delete' => 'Kan roles verwijderen',
        ],
    ],
    'fields'   => [
        'name'   => 'Velden',
        'option' => [
            'manage' => 'Kan custom velden beheren.',
        ],
    ],
    'settings' => [
        'name'   => 'Instellingen',
        'option' => [
            'manage' => 'Kan addon instellingen beheren.',
        ],
    ],
];
