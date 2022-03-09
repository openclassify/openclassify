<?php

return [
    'name'              => [
        'label'        => '站点名称',
        'instructions' => '站点的名称?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'       => [
        'label'        => '站点描述',
        'instructions' => '站点的描述或标语?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'business'          => [
        'label'        => '公司名称',
        'instructions' => '公司的名称?',
    ],
    'phone'             => [
        'label'        => '联系电话',
        'instructions' => '指定主要的联系电话号码.',
    ],
    'address'           => [
        'label' => '地址',
    ],
    'address2'          => [
        'label' => '门牌号码.',
    ],
    'city'              => [
        'label' => '城市',
    ],
    'state'             => [
        'label' => '地区/省份',
    ],
    'postal_code'       => [
        'label' => '邮政编码',
    ],
    'country'           => [
        'label' => '国家',
    ],
    'timezone'          => [
        'label'        => '时区',
        'instructions' => '指定站点的默认时区.',
    ],
    'unit_system'       => [
        'label'        => '单位系统',
        'instructions' => '指定站点的单位系统.',
        'option'       => [
            'imperial' => '英制',
            'metric'   => '公制',
        ],
    ],
    'currency'          => [
        'label'        => '货币',
        'instructions' => '指定站点默认使用的货币.',
    ],
    'date_format'       => [
        'label'        => '日期格式',
        'instructions' => '指定站点默认的日期格式.',
    ],
    'time_format'       => [
        'label'        => '时间格式',
        'instructions' => '指定站点默认的时间格式.',
    ],
    'default_locale'    => [
        'label'        => '语言',
        'instructions' => '指定站点的默认语言.'
    ],
    'enabled_locales'   => [
        'label'        => '启用的语言',
        'instructions' => '指定站点支持的语言.'
    ],
    'maintenance'       => [
        'label'        => '维护模式',
        'instructions' => '使用此选项停止站点的前台系统.<br>打算进行维护或开发时适用.',
    ],
    'debug'             => [
        'label'        => 'Debug模式',
        'instructions' => '启用是显示详细的错误信息.',
    ],
    'ip_whitelist'      => [
        'label'        => 'IP 白名单',
        'instructions' => '当状态设定为 "禁用" 时，这些 IP 才能允许存取这个网站。',
        'placeholder'  => '请使用半形字的逗点来区隔多个 IP。'
    ],
    'basic_auth'        => [
        'label'        => '认证提示?',
        'instructions' => '在开启维护模式时, 提示用户进行HTTP认证?',
    ],
    '503_message'       => [
        'label'        => '站点不可用信息',
        'instructions' => '当网站状态设定为禁用或有重大问题产生时将会显示此信息.',
        'placeholder'  => '马上回来'
    ],
    'email'             => [
        'label'        => '系统Email',
        'instructions' => '为系统生成的信息设定默认Email.',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'            => [
        'label'        => '发送者',
        'instructions' => '指定系统生成信息的"From" 名称(发送者).',
    ],
    'standard_theme'    => [
        'label'        => '前台主题模板',
        'instructions' => '要使用哪一个前台主题模板?',
    ],
    'admin_theme'       => [
        'label'        => '后台主题模板',
        'instructions' => '要使用哪一个前台主题模板?',
    ],
    'per_page'          => [
        'label'        => '每页条目数',
        'instructions' => '指定每页显示的条目数量.',
    ],
];
