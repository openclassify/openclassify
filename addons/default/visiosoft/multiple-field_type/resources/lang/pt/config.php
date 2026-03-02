<?php

return [
    'related'    => [
        'label'        => 'Stream Relacionado',
        'instructions' => 'Especifique as entradas de fluxo relacionadas a serem exibidas na lista suspensa.',
    ],
    'mode'       => [
        'label'  => 'Modo de entrada',
        'option' => [
            'tags'       => 'Tag',
            'lookup'     => 'Olho para cima',
            'checkboxes' => 'Caixas de seleção',
        ],
    ],
    'min'        => [
        'label'        => 'Seleções mínimas',
        'instructions' => 'Especifique o número mínimo de seleções permitidas.',
    ],
    'max'        => [
        'label'        => 'Seleções máximas',
        'instructions' => 'Especifique o número máximo de seleções permitidas.',
    ],
    'title_name' => [
        'label'        => 'Campo de Título',
        'placeholder'  => 'primeiro nome',
        'instructions' => 'Especifique <strong>slug</strong> do campo a ser exibido nas opções suspensas / de pesquisa.<br>Você pode especificar títulos analisáveis como <strong>{entry.first_name} {entry.last_name}</strong><br>A coluna de título do fluxo relacionado será usada por padrão.',
    ],
];
