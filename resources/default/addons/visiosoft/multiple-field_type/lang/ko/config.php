<?php

return [
    'related'    => [
        'label'        => '관련 스트림',
        'instructions' => '드롭 다운에 표시 할 관련 스트림 항목을 지정합니다.',
    ],
    'mode'       => [
        'label'  => '입력 모드',
        'option' => [
            'tags'       => '태그',
            'lookup'     => '조회',
            'checkboxes' => '체크 박스',
        ],
    ],
    'min'        => [
        'label'        => '최소 선택',
        'instructions' => '허용되는 최소 선택 수를 지정합니다.',
    ],
    'max'        => [
        'label'        => '최대 선택',
        'instructions' => '허용되는 최대 선택 수를 지정합니다.',
    ],
    'title_name' => [
        'label'        => '제목 필드',
        'placeholder'  => '이름',
        'instructions' => '드롭 다운 / 검색 옵션에 대해 표시 할 필드 <strong>슬러그</strong> 을 지정합니다.<br> <strong>{entry.first_name} {entry.last_name}</strong><br>과 같이 구문 분석 가능한 제목을 지정할 수 있습니다. 관련 스트림의 제목 열이 기본적으로 사용됩니다.',
    ],
];
