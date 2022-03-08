<?php

return [
    'max_attempts'      => [
        'label'        => '尝试登入次数',
        'instructions' => '在 <strong>限制时间间隔</strong> 中允许用户尝试登入多少次?',
    ],
    'throttle_interval' => [
        'label'        => '限制时间间隔',
        'instructions' => '在指定的时间内(分钟)若用户 <strong>尝试登入次数</strong> 已达到, 则锁定用户的登入动作.',
    ],
    'lockout_interval'  => [
        'label'        => '锁定时间间隔',
        'instructions' => '指定允许用户重新尝试登入所需等待的时间间隔(分钟).',
    ],
];
