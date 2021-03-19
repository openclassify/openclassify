<?php

return [
    'folders' => [
        'name'         => 'Složky',
        'instructions' => 'Určete, které složky jsou pro toto pole k dispozici. Chcete-li zobrazit všechny složky, ponechte toto pole prázdné.',
        'warning'      => 'Stávající oprávnění pro složky mají přednost před vybranými složkami.',
    ],
    'max'     => [
        'name'         => 'Maximální velikost nahrávání',
        'instructions' => 'Určete maximální velikost nahrávání v <strong>MB</strong>.',
        'warning'      => 'Pokud není uvedeno, bude místo toho použita max. Složka a pak max. Serveru.',
    ],
    'mode'    => [
        'name'         => 'Režim vstupu',
        'instructions' => 'Jak by uživatelé měli zadávat soubory?',
        'option'       => [
            'default' => 'Nahrajte a / nebo vyberte soubory.',
            'select'  => 'Vyberte pouze soubory.',
            'upload'  => 'Nahrávejte pouze soubory.',
        ],
    ],
];
