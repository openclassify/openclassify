<?php

return [
    'folders' => [
        'name'         => '文件夹',
        'instructions' => '指定字段对应的可用文件夹. 留空则显示所有文件夹.',
        'warning'      => '已存在的文件夹权限优先于所选文件夹.',
    ],
    'max'     => [
        'name'         => '最大上传文件大小',
        'instructions' => '指定最大的上传文件大小, 单位为 <strong>MB</strong>.',
        'warning'      => '若不指定则使用服务器的设置值.',
    ],
];
