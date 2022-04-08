<?php

return [
    'name' => [
        'name'     => 'Nome',
    'instructions' => [
        'menus' => 'Indica un breve e descrittivo nome per questo menu.',
    ],
    ],
    'slug' => [
        'name'     => 'Slug',
    'instructions' => 'Lo slug sarà utilizzato per mostrare il menu.',
    ],
    'description' => [
        'name'     => 'Descrizione',
    'instructions' => 'Descrivi brevemente questo menu.',
    ],
    'target' => [
        'name'     => 'Target',
    'instructions' => 'Come deve essere aperto il link dopo il click?',
    'option'       => [
        'self' => 'Apri nella finestra corrente.',
    'blank'    => 'Apri in una nuova finestra',
    ],
    ],
    'class' => [
        'name'     => 'Classe',
    'instructions' => 'Indica qualsiasi classe necessaria per il tuo sviluppatore.',
    ],
    'allowed_roles' => [
        'name'     => 'Ruoli consentiti',
    'instructions' => 'Indica quali ruoli possono vedere questo link.',
    'warning'      => 'Se non viene specificato nessun ruolo il link sarà visibile a chiunque.',
    ],
];