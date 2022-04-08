<?php

return [
    'name'             => [
        'name'         => '名称',
        'instructions' => [
            'types'      => '为文章类型指定一个简短的名称.',
            'categories' => '为分类指定一个简短的名称.',
        ],
    ],
    'title'            => [
        'name'         => '标题',
        'instructions' => '为文章指定一个简短的标题.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types'      => '此 Slug 用于建立此类型文章的数据表.',
            'categories' => '此 Slug 用于生成分类的 URL.',
            'posts'      => '此 slug 用于生成文章的 URL.',
        ],
    ],
    'description'      => [
        'name'         => '描述',
        'instructions' => [
            'types'      => '简要描述此文章类型.',
            'categories' => '简要描述此分类.',
        ],
        'warning'      => '视乎网站的构建情况，该设置未必在前台显示.',
    ],
    'summary'          => [
        'name'         => '摘要',
        'instructions' => '输入简洁的内容摘要以介绍此文章.',
    ],
    'category'         => [
        'name'         => '分类',
        'instructions' => '选择文章所属的分类.',
    ],
    'meta_title'       => [
        'name'         => 'Meta 标题',
        'instructions' => '指定 SEO 标题.',
        'warning'      => '默认使用文章标题.',
    ],
    'meta_description' => [
        'name'         => 'Meta 描述',
        'instructions' => '指定 SEO 描述.',
    ],
    'theme_layout'     => [
        'name'         => '主题排版',
        'instructions' => '指定主题排版用以包嵌 <strong>post layout</strong> .',
    ],
    'layout'           => [
        'name'         => '文章排版',
        'instructions' => '此排版用于显示文章内容.',
    ],
    'tags'             => [
        'name'         => '标签',
        'instructions' => '指定标签有助于为文章分组.',
    ],
    'enabled'          => [
        'name'         => '启用',
        'label'        => '启用文章?',
        'instructions' => '即时禁用亦可以通过后台的安全链接预览文章.',
        'warning'      => '必须启用文章才可在前台浏览.',
    ],
    'featured'         => [
        'name'         => '特殊',
        'label'        => '为特殊文章?',
        'instructions' => '特殊文章更加引人瞩目.',
        'warning'      => '视乎网站的构建情况，该设置未必会生效.',
    ],
    'publish_at'       => [
        'name'         => '发布日期/时间',
        'instructions' => '为文章指定发布日期.',
        'warning'      => '若指定将来发布, 文章在到该日期之前都不会显示.',
    ],
    'author'           => [
        'name'         => '作者',
        'instructions' => '指定文章的作者.',
    ],
    'status'           => [
        'name'   => '状态',
        'option' => [
            'live'      => '在线',
            'draft'     => '草稿',
            'scheduled' => '计划',
        ],
    ],
    'content'          => [
        'name' => '内容',
    ],
];
