<?php

return [
    'related'    => [
        'label'        => 'Luồng liên quan',
        'instructions' => 'Chỉ định các mục nhập luồng liên quan để hiển thị trong menu thả xuống.',
    ],
    'mode'       => [
        'label'  => 'Chế độ đầu vào',
        'option' => [
            'tags'       => 'Thẻ',
            'lookup'     => 'Tra cứu',
            'checkboxes' => 'Hộp kiểm',
        ],
    ],
    'min'        => [
        'label'        => 'Lựa chọn tối thiểu',
        'instructions' => 'Chỉ định số lượng tối thiểu các lựa chọn được phép.',
    ],
    'max'        => [
        'label'        => 'Lựa chọn tối đa',
        'instructions' => 'Chỉ định số lượng tối đa các lựa chọn được phép.',
    ],
    'title_name' => [
        'label'        => 'Trường tiêu đề',
        'placeholder'  => 'tên đầu tiên',
        'instructions' => 'Chỉ định <strong>slug</strong> của trường để hiển thị cho các tùy chọn thả xuống / tìm kiếm.<br>Bạn có thể chỉ định tiêu đề có thể phân tích cú pháp như <strong>{entry.first_name} {entry.last_name}</strong><br>Cột tiêu đề của luồng liên quan sẽ được sử dụng theo mặc định.',
    ],
];
