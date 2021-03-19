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
        'warning'      => 'Se não for especificado, a pasta max e o server max serão usados.',
    ],
    'mode'    => [
        'name'         => 'Modo de entrada',
        'instructions' => 'Como os usuários devem fornecer entrada de arquivo?',
        'option'       => [
            'default' => 'Faça upload e / ou selecione arquivos.',
            'select'  => 'Selecione apenas arquivos.',
            'upload'  => 'Faça upload de arquivos apenas.',
        ],
    ],
];
