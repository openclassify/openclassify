<?php

return [
    'folders' => [
        'name'         => 'Složky',
        'instructions' => 'Určete, které složky jsou pro toto pole k dispozici. Chcete-li zobrazit všechny složky, ponechte toto pole prázdné.',
        'warning'      => 'Stávající oprávnění pro složky mají přednost před vybranými složkami.',
    ],
    'min'     => [
        'label'        => 'Minimální výběr',
        'instructions' => 'Zadejte minimální počet povolených výběrů.',
    ],
    'max'     => [
        'label'        => 'Maximální výběr',
        'instructions' => 'Zadejte maximální počet povolených výběrů.',
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
