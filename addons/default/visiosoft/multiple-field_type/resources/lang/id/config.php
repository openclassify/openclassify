<?php

return [
    'related'    => [
        'label'        => 'Aliran Terkait',
        'instructions' => 'Tentukan entri aliran terkait untuk ditampilkan di tarik-turun.',
    ],
    'mode'       => [
        'label'  => 'Mode Masukan',
        'option' => [
            'tags'       => 'Tag',
            'lookup'     => 'Mencari',
            'checkboxes' => 'Kotak centang',
        ],
    ],
    'min'        => [
        'label'        => 'Seleksi Minimum',
        'instructions' => 'Tentukan jumlah minimum pilihan yang diizinkan.',
    ],
    'max'        => [
        'label'        => 'Pilihan Maksimum',
        'instructions' => 'Tentukan jumlah maksimum pilihan yang diperbolehkan.',
    ],
    'title_name' => [
        'label'        => 'Bidang Judul',
        'placeholder'  => 'nama depan',
        'instructions' => 'Tentukan bidang <strong>siput</strong> akan ditampilkan untuk opsi tarik-turun / pencarian.<br>Anda dapat menentukan judul yang dapat diuraikan seperti <strong>{entry.first_name} {entry.last_name}</strong><br>Kolom judul aliran terkait akan digunakan secara default.',
    ],
];
