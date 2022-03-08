<?php

return [
    'from'   => [
        'name'         => '从',
        'label'        => '重定向自',
        'placeholder'  => 'foo/bar/{var}',
        'instructions' => '指定路径或匹配模式以重定向. 例如 <strong>foo/bar/{var}</strong> 或 <strong>foo/bar</strong> 或 <strong>http://{account}.old.com/{path}</strong>.',
    ],
    'to'     => [
        'name'         => '到',
        'label'        => '重定向到',
        'placeholder'  => 'bar/{var}',
        'instructions' => '指定路径, 匹配替换字符或URL以跳转. 例如 <strong>bar/{var}</strong> 或 <strong>bar/baz</strong> 或 <strong>https://new.com/account/{account}/{path}</strong>.',
    ],
    'status' => [
        'name'         => '状态',
        'instructions' => '为何种类型的重定向?',
        'option'       => [
            '301' => '301 - 永久重定向',
            '302' => '302 - 临时重定向',
        ],
    ],
    'secure' => [
        'name'         => '安全',
        'label'        => '重定向到安全的URL(HTTPS)?',
        'instructions' => '要在跳转时强制使用安全链接（HTTPS)?',
        'warning'      => '若 <strong>Redirect To</strong> 的值里包含协议（HTTP/HTTPS), 此选项会被忽略.',
    ],
];
