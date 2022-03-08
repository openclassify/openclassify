<?php

return [
    'folders' => [
        'name'         => 'Thư mục',
        'instructions' => 'Chỉ định thư mục nào có sẵn cho trường này. Để trống để hiển thị tất cả các thư mục.',
        'warning'      => 'Quyền thư mục hiện có được ưu tiên hơn các thư mục được chọn.',
    ],
    'max'     => [
        'name'         => 'Kích thước tải lên tối đa',
        'instructions' => 'Chỉ định kích thước tải lên tối đa trong <strong>megabyte</strong>.',
        'warning'      => 'Nếu không được chỉ định thư mục max và sau đó máy chủ max sẽ được sử dụng thay thế.',
    ],
    'mode'    => [
        'name'         => 'Chế độ đầu vào',
        'instructions' => 'Người dùng nên cung cấp đầu vào tập tin như thế nào?',
        'option'       => [
            'default' => 'Tải lên và / hoặc chọn tập tin.',
            'select'  => 'Chỉ chọn tệp.',
            'upload'  => 'Chỉ tải lên tệp.',
        ],
    ],
];
