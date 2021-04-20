<?php

return [
    'folders' => [
        'name'         => 'Folderi',
        'instructions' => 'Navedite koje su fascikle dostupne za ovo polje. Ostavite prazno za prikaz svih direktorijuma.',
        'warning'      => 'Postojeće dozvole za fascikle imaju prednost nad odabranim direktorijumima.',
    ],
    'min'     => [
        'label'        => 'Minimalni odabir',
        'instructions' => 'Unesite minimalni broj dozvoljenih izbora.',
    ],
    'max'     => [
        'label'        => 'Maksimalni odabir',
        'instructions' => 'Unesite maksimalan broj dozvoljenih izbora.',
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
