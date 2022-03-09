<?php

return [
    'field'        => [
        'name'         => 'Campo',
        'label'        => 'Campo',
        'instructions' => 'Escolha o campo para vincular.'
    ],
    'label'        => [
        'name'         => 'Rótulo',
        'instructions' => 'Rótulos são usados apenas em formulários. Será usado o nome do campo caso não tenha valor definido.'
    ],
    'required'     => [
        'name'         => 'Obrigatório',
        'label'        => 'Este campo é obrigatório?',
        'instructions' => 'Se obrigatório, este ter SEMPRE um valor.'
    ],
    'unique'       => [
        'name'         => 'Único',
        'label'        => 'Este campo é único?',
        'instructions' => 'Se único, este campo não poderá ter valores repetidos.'
    ],
    'translatable' => [
        'name'         => 'Traduzível',
        'label'        => 'Is this field translatable?',
        'instructions' => 'If translatable this field will be available in all enabled locales.',
        'warning'      => 'The associated field type does not support translated values.'
    ],
    'instructions' => [
        'name'         => 'Instruções',
        'instructions' => 'Instruções serão exibidas em formulários para os usuários'
    ],
    'warning'      => [
        'name'         => 'Alertas',
        'instructions' => 'Alertas servem para chamar atenção ao que importa'
    ]
];
