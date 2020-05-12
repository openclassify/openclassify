<?php

return [
    'folders' => [
        'name'         => '폴더',
        'instructions' => '이 필드에 사용할 수있는 폴더를 지정하십시오. 모든 폴더를 표시하려면 비워 두십시오.',
        'warning'      => '기존 폴더 권한이 선택한 폴더보다 우선합니다.',
    ],
    'min'     => [
        'label'        => '최소 선택',
        'instructions' => '허용되는 최소 선택 수를 입력하십시오.',
    ],
    'max'     => [
        'label'        => '최대 선택',
        'instructions' => '허용되는 최대 선택 수를 입력하십시오.',
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
