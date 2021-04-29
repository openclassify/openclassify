<?php

return [
    'related'    => [
        'label'        => 'Související stream',
        'instructions' => 'Určete související položky streamu, které se mají zobrazit v rozbalovací nabídce.',
    ],
    'mode'       => [
        'label'  => 'Režim vstupu',
        'option' => [
            'tags'       => 'Značky',
            'lookup'     => 'Vzhlédnout',
            'checkboxes' => 'Zaškrtávací políčka',
        ],
    ],
    'min'        => [
        'label'        => 'Minimální výběr',
        'instructions' => 'Určete minimální počet povolených výběrů.',
    ],
    'max'        => [
        'label'        => 'Maximální výběr',
        'instructions' => 'Zadejte maximální počet povolených výběrů.',
    ],
    'title_name' => [
        'label'        => 'Pole názvu',
        'placeholder'  => 'jméno',
        'instructions' => 'Určete <strong>slimáka</strong> pole, které se má zobrazit pro možnosti rozevíracího seznamu / vyhledávání.<br>Můžete zadat srovnatelné tituly jako <strong>{entry.first_name} {entry.last_name}</strong><br>Ve výchozím nastavení se použije sloupec názvu souvisejícího streamu.',
    ],
];
