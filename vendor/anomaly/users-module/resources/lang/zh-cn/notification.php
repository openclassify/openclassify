<?php

return [
    'activate_your_account' => [
        'subject'      => '激活账户',
        'greeting'     => '您好, :display_name!',
        'instructions' => '感谢您的注册! 请点击下方的按钮以激活您的账户.',
        'button'       => '激活账户',
    ],
    'user_pending_activation' => [
        'subject'       => '用户等待激活中',
        'instructions'  => ':username 已注册并等待激活. 请点击下方的按钮以激活他们的账户.',
        'button'        => '激活账户',
    ],
    'reset_your_password' => [
        'subject'      => '重设密码',
        'greeting'     => '你好, :display_name!',
        'notice'       => '账户密码需要重设.',
        'warning'      => '若该请求不是由您发起的, 可忽略此 Email.',
        'instructions' => '若您确实需要重设您的密码, 请点击下方按钮.',
        'button'       => '重设密码',
    ],
    'user_has_registered' => [
        'subject'       => '用户已注册',
        'instructions'  => ':username 已注册! 点击下方按钮以查看.',
        'button'        => '查看用户资料',
    ],
];
