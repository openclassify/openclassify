<?php

return [
    'folders' => [
        'name'         => 'Qovluqlar',
        'instructions' => 'Bu sahə üçün hansı qovluqların olduğunu göstərin. Bütün qovluqları göstərmək üçün boş buraxın.',
        'warning'      => 'Mövcud qovluq icazələri seçilmiş qovluqlardan üstündür.',
    ],
    'max'     => [
        'name'         => 'Maksimum yükləmə ölçüsü',
        'instructions' => 'Ən çox yükləmə ölçüsünü <strong>meqabayt</strong>də göstərin.',
        'warning'      => 'Göstərilmədiyi halda qovluq max və sonra server max istifadə ediləcəkdir.',
    ],
    'mode'    => [
        'name'         => 'Giriş rejimi',
        'instructions' => 'İstifadəçilər fayl girişini necə təmin etməlidirlər?',
        'option'       => [
            'default' => 'Yükləyin və / və ya faylları seçin.',
            'select'  => 'Yalnız faylları seçin.',
            'upload'  => 'Yalnız faylları yükləyin.',
        ],
    ],
];
