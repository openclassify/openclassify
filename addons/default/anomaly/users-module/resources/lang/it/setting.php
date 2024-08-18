<?php

return [
    'login' => [
        'label'    => 'Campi di login',
    'instructions' => 'Quali campi vuoi utilizzare per effettuare il login?',
    'option'       => [
        'email' => 'Email',
    'username'  => 'Username',
    ],
    ],
    'activation_mode' => [
        'label'    => 'Tipo di attivazione',
    'instructions' => 'Come devono essere attivati gli utenti dopo la registrazione?',
    'option'       => [
        'email' => 'Invia una email di attivazione.',
    'manual'    => 'Richiede che un amministratore attivi manualmente l&#039;account.',
    'automatic' => 'Attiva automaticamente l&#039;account dopo la registrazione.',
    ],
    ],
];