<?php

return [
    'name'              => [
        'label'        => 'Nome do site',
        'instructions' => 'Qual o nome da sua aplicação?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'       => [
        'label'        => 'Descrição do site',
        'instructions' => 'Qual a descrição ou slogan da sua aplicação?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'business'          => [
        'label'        => 'Nome de negócio',
        'instructions' => 'Qual a denominação legal do seu negócio?',
    ],
    'phone'             => [
        'label'        => 'Telefone',
        'instructions' => 'Especifique seu telefone de conto.',
    ],
    'address'           => [
        'label' => 'Endereço',
    ],
    'address2'          => [
        'label' => 'Apt, casa, etc.',
    ],
    'city'              => [
        'label' => 'Cidade',
    ],
    'state'             => [
        'label' => 'Estado',
    ],
    'postal_code'       => [
        'label' => 'CEP',
    ],
    'country'           => [
        'label' => 'País',
    ],
    'timezone'          => [
        'label'        => 'Fuso horáro',
        'instructions' => 'Especifique o fuso-horário do site.',
    ],
    'currency'          => [
        'label'        => 'Moeda',
        'instructions' => 'Especifique a moeda do site.',
    ],
    'date_format'       => [
        'label'        => 'Formato de data',
        'instructions' => 'Especifique o formato de data padrão do site.',
    ],
    'time_format'       => [
        'label'        => 'Formato de hora',
        'instructions' => 'Especifique o formato de hora padrão do site.',
    ],
    'default_locale'    => [
        'label'        => 'Idioma',
        'instructions' => 'Especifique o idioma do site.',
    ],
    'enabled_locales'   => [
        'label'        => 'Idiomas disponíveis',
        'instructions' => 'Especifique quais idiomas disponíveis no site',
    ],
    'maintenance'       => [
        'label'        => 'Modo de manutenção',
        'instructions' => 'Use esta opção para desabilitar o a visualização pública do sistema.<br>Isto é indicado para quando for preciso desabilitar o acesso dos usuários durante manutenção ou desenvolvimento do site.',
    ],
    'debug'             => [
        'label'        => 'Modo de depuração',
        'instructions' => 'Quando habilitado, erros serão exibidos em mensagens detalhadas.',
    ],
    'ip_whitelist'      => [
        'label'        => 'IP Whitelist',
        'instructions' => 'Quando o modo de manutenção está habilitado, estes endereços IP terão permissão para acessar a aplicação.',
        'placeholder'  => 'Separate each IP address with a comma.',
    ],
    'basic_auth'        => [
        'label'        => 'Exigir autenticação?',
        'instructions' => 'Quando o modo de manutenção está habilitato, exigue que os usuários autentiquem-se via HTTP.?',
    ],
    '503_message'       => [
        'label'        => 'Mensagem de Indisponibilidade',
        'instructions' => 'Quando o site está fora do ar ou há algum problema, esta mensagem será exibida para os usuários.',
        'placeholder'  => 'Volto logo.',
    ],
    'email'             => [
        'label'        => 'E-mail do Sistema',
        'instructions' => 'Especifique o e-mail padrão para mensagens geradas pelo sistema..',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'            => [
        'label'        => 'Remetente',
        'instructions' => 'Especifique o nome que será usada para mensagens geradas pelo sistema.',
    ],
    'standard_theme'    => [
        'label'        => 'Tema público',
        'instructions' => 'Qual tema você gostaria de usar para apresentar na parte pública da aplicação?',
    ],
    'admin_theme'       => [
        'label'        => 'Tema Administrativo',
        'instructions' => 'Qual tema você gostaria de usar no painel de controle?',
    ],
    'per_page'          => [
        'label'        => 'Resultados por Página',
        'instructions' => 'Especifique o número padrão de resultados a serem exibidos em cada página.',
    ],
];
