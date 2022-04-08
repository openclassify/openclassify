<?php

return [
    'folders' => [
        'name'         => '폴더',
        'instructions' => '이 필드에 사용할 수있는 폴더를 지정하십시오. 모든 폴더를 표시하려면 비워 두십시오.',
        'warning'      => '기존 폴더 권한이 선택한 폴더보다 우선합니다.',
    ],
    'max'     => [
        'name'         => '최대 업로드 크기',
        'instructions' => '의 최대 업로드 크기 지정 <strong>메가 바이트</strong>.',
        'warning'      => '지정하지 않으면 max 폴더와 server max가 대신 사용됩니다.',
    ],
    'mode'    => [
        'name'         => '입력 모드',
        'instructions' => '사용자는 파일 입력을 어떻게 제공해야합니까?',
        'option'       => [
            'default' => '파일을 업로드 및 / 또는 선택합니다.',
            'select'  => '파일 만 선택하십시오.',
            'upload'  => '파일 만 업로드하십시오.',
        ],
    ],
];
