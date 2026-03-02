<?php

return [
    'folders' => [
        'name'         => 'Pastas',
        'instructions' => 'Especifique quais pastas estão disponíveis para este campo. Deixe em branco para exibir todas as pastas.',
        'warning'      => 'As permissões de pasta existentes têm precedência sobre as pastas selecionadas.',
    ],
    'min'     => [
        'label'        => 'Seleções Mínimas',
        'instructions' => 'Digite o número mínimo de seleções permitidas.',
    ],
    'max'     => [
        'label'        => 'Seleções máximas',
        'instructions' => 'Digite o número máximo de seleções permitidas.',
    ],
    'mode'    => [
        'name'         => 'Modo de entrada',
        'instructions' => 'Como os usuários devem fornecer entrada de arquivo?',
        'option'       => [
            'default' => 'Carregar e / ou selecionar arquivos.',
            'select'  => 'Selecione apenas arquivos.',
            'upload'  => 'Carregar apenas arquivos.',
        ],
    ],
];
