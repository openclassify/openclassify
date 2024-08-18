<?php

return [
    'login' => [
        'label'    => 'Bejelentkezés Mező',
    'instructions' => 'Melyik mezőt használljuk a bejelentkezéshez?',
    'option'       => [
        'email' => 'Email',
    'username'  => 'Felhasználónév',
    ],
    ],
    'activation_mode' => [
        'label'    => 'Aktiválás Módja',
    'instructions' => 'Hogyan aktiváljuk a felhasználókat a regisztráció után?',
    'option'       => [
        'email' => 'Aktiváló email küldése a felhasználónak.',
    'manual'    => 'Az adminisztrátor kézzel aktiválja a felhasználót.',
    'automatic' => 'Automatikusan aktiválódjon a felhasználó a regisztráció után.',
    ],
    ],
];