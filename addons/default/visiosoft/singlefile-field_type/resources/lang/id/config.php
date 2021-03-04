<?php

return [
    'folders' => [
        'name'         => 'Folder',
        'instructions' => 'Tentukan folder mana yang tersedia untuk bidang ini. Biarkan kosong untuk menampilkan semua folder.',
        'warning'      => 'Izin folder yang sudah ada lebih diutamakan daripada folder yang dipilih.',
    ],
    'max'     => [
        'name'         => 'Ukuran Unggahan Maks',
        'instructions' => 'Tentukan ukuran unggahan maksimal dalam <strong>megabyte</strong>.',
        'warning'      => 'Jika tidak ditentukan folder max dan kemudian server max akan digunakan sebagai gantinya.',
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
