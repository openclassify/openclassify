<?php

return [
    'folders' => [
        'name'         => 'Pastas',
        'instructions' => 'Especifique quais pastas estão disponíveis para este campo. Deixe em branco para exibir todas as pastas.',
        'warning'      => 'As permissões de pasta existentes têm precedência sobre as pastas selecionadas.',
    ],
    'max'     => [
        'name'         => 'Tamanho máximo de upload',
        'instructions' => 'Especifique o tamanho máximo de upload em <strong>megabytes</strong>.',
        'warning'      => 'Se não for especificada, a pasta max e o servidor max serão usados.',
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
