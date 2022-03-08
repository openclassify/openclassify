<?php

return [
    'folders' => [
        'name'         => 'Folderi',
        'instructions' => 'Navedite koje su fascikle dostupne za ovo polje. Ostavite prazno za prikaz svih direktorijuma.',
        'warning'      => 'Postojeće dozvole za fascikle imaju prednost nad odabranim direktorijumima.',
    ],
    'max'     => [
        'name'         => 'Maksimalna veličina otpremanja',
        'instructions' => 'Navedite maksimalnu veličinu otpremanja u <strong>megabajtima</strong>.',
        'warning'      => 'Ako nije navedeno, umesto toga koristiće se folder max, a zatim server max.',
    ],
    'mode'    => [
        'name'         => 'Mod unosa',
        'instructions' => 'Kako korisnici treba da obezbede unos datoteka?',
        'option'       => [
            'default' => 'Otpremite i / ili izaberite datoteke.',
            'select'  => 'Izaberite samo datoteke.',
            'upload'  => 'Отпреми само датотеке.',
        ],
    ],
];
