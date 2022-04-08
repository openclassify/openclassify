<?php

return [
    'max_attempts' => [
        'label'    => 'Engedélyezett Belépési Próbálkozások',
    'instructions' => 'Mennyi hibás belépési próbálkozás legyen engedélyezve a lassítási időtartam előtt?',
    ],
    'throttle_interval' => [
        'label'    => 'Lassítási Időtartam',
    'instructions' => 'Ha az engedélyezett belépési próbálkozások száma eléri a beállított értéket a megadott időtartamon belül kizárjuk a felhasználót. ',
    ],
    'lockout_interval' => [
        'label'    => 'Kizárás Időtartama',
    'instructions' => 'Határozd meg, hogy hány percre zárjuk ki a felhasználót.',
    ],
];