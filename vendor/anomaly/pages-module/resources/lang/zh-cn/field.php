<?php

return [
    'title'            => [
        'name'         => '标题',
        'instructions' => '页面的简短名称.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types' => 'Slug 用于建立此类型页面的数据表.',
            'pages' => 'Slug 用于生成此页面的URL.',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Meta 标题',
        'instructions' => '指定 SEO 标题.',
        'warning'      => '默认使用页面标题.',
    ],
    'meta_description' => [
        'name'         => 'Meta 描述',
        'instructions' => '指定 SEO 描述内容.',
    ],
    'name'             => [
        'name'         => '名称',
        'instructions' => '为页面类型指定一个简短的名称.',
    ],
    'description'      => [
        'name'         => '描述',
        'instructions' => '简短描述此页面类型.',
    ],
    'theme_layout'     => [
        'name'         => '主题模板排版',
        'instructions' => '指定主题模板排版以嵌入 <strong>页面排版</strong> .',
    ],
    'layout'           => [
        'name'         => '页面排版',
        'instructions' => '用于页面内容的排版.',
    ],
    'allowed_roles'    => [
        'name'         => '允许的角色',
        'instructions' => '仅某些指定的用户角色允许访问此页面.',
        'warning'      => '若不指定任何用户角色则所有人均可访问此页面.',
    ],
    'visible'          => [
        'name'         => '可见',
        'label'        => '在导航中显示此页面?',
        'instructions' => '禁用则不在导航中显示此页面.',
        'warning'      => '此设置基于网站的构建形式, 或许不会有效果.',
    ],
    'exact'            => [
        'name'         => 'URI匹配',
        'label'        => '需要完全匹配的URI?',
        'instructions' => '禁用则允许此URI后带有自定义参数.',
    ],
    'enabled'          => [
        'name'         => '启用',
        'label'        => '是否启用此页面?',
        'instructions' => '即使禁用亦可通过后台安全的预览链接访问此页面进行预览.',
        'warning'      => '必须启用页面才会在 <strong>前台</strong> 可访问.',
    ],
    'home'             => [
        'name'         => '首页',
        'label'        => '设为首页?',
        'instructions' => '首页为站点的默认打开页面.',
    ],
    'parent'           => [
        'name' => '父页面',
    ],
    'handler'          => [
        'name'         => '页面处理',
        'instructions' => '页面处理负责为页面建立全部的 HTTP 响应 .',
    ],
    'content'          => [
        'name' => '内容',
    ],
    'path'             => [
        'name' => '路径',
    ],
];
