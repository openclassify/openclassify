<?php

return [
    'folders' => [
        'name'         => 'Folder',
        'instructions' => 'Tentukan folder mana yang tersedia untuk bidang ini. Biarkan kosong untuk menampilkan semua folder.',
        'warning'      => 'Izin folder yang sudah ada lebih diutamakan daripada folder yang dipilih.',
    ],
    'min'     => [
        'label'        => 'Pilihan Minimum',
        'instructions' => 'Masukkan jumlah minimum pilihan yang diperbolehkan.',
    ],
    'max'     => [
        'label'        => 'Seleksi Maksimum',
        'instructions' => 'Masukkan jumlah maksimum pilihan yang diperbolehkan.',
    ],
    'mode'    => [
        'name'         => 'Mode Masukan',
        'instructions' => 'Bagaimana seharusnya pengguna memberikan masukan file?',
        'option'       => [
            'default' => 'Unggah dan / atau pilih file.',
            'select'  => 'Pilih file saja.',
            'upload'  => 'Unggah file saja.',
        ],
    ],
];
