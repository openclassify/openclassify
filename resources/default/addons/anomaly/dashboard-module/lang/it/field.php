<?php

return [
    'name' => [
        'name'     => 'Nome',
    'instructions' => 'Indica un nome breve e descrittivo per la dashboard.',
    ],
    'title' => [
        'name'     => 'Titolo',
    'instructions' => 'Indica un nome breve e descrittivo per il widget.',
    ],
    'slug' => [
        'name'     => 'Slug',
    'instructions' => 'Lo slug è utilizzato nell&amp;#039;url della dashboard.',
    ],
    'description' => [
        'name'     => 'Descrizione',
    'instructions' => [
        'dashboards' => 'Descrivi brevemente questa dashboard.',
    'widgets'        => 'Descrivi brevemente questo widget.',
    ],
    ],
    'layout' => [
        'name'     => 'Layout',
    'instructions' => 'Il layout determina come possono essere organizzati i widget nella dashboard.',
    'option'       => [
        '24'  => 'Colonna singola',
    '12-12'   => 'Due colonne uguali',
    '16-8'    => 'Due colonne - quella a sinistra più grande',
    '8-16'    => 'Due colonne - quella a destra più grande',
    '8-8-8'   => 'Tre colonne uguali',
    '6-12-6'  => 'Due colonne - quella in centro più grande',
    '12-6-6'  => 'Tre colonne - quella a sinistra più grande',
    '6-6-12'  => 'Due colonne - quella a destra più grande',
    '6-6-6-6' => 'Quattro colonne uguali',
    ],
    ],
    'dashboard' => [
        'name'     => 'Dashboard',
    'instructions' => 'Scegli a quale dashboard appartiene il widget.',
    ],
    'extension' => [
        'name' => 'Estensione',
    ],
    'pinned' => [
        'name'     => 'Fissata',
    'label'        => 'Fissare questo widget?',
    'instructions' => 'I widget fissati sono messi in cima alla dashboard e con larghezza massima.',
    ],
    'allowed_roles' => [
        'name'     => 'Ruoli abilitati',
    'instructions' => [
        'dashboards' => 'Specifica quali ruoli possono accedere a questa dashboard.',
    'widgets'        => 'Specifica quali ruoli possono vedere questo widget.',
    ],
    'warning' => [
        'dashboards' => 'Se non viene specificato nessun ruolo tutti gli utenti possono accedere a questa dashboard.',
    'widgets'        => 'Se non viene specificato nessun ruolo tutti gli utenti possono accedere a questo addon e vedere questo widget.',
    ],
    ],
];