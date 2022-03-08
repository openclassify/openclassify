<?php

return [
    'title' => [
        'name'     => 'Titolo',
    'instructions' => 'Indica un breve ma descrittivo nome per questa pagina.',
    ],
    'slug' => [
        'name'     => 'Slug',
    'instructions' => [
        'types' => 'Lo slug è utilizzato per la creazione della tabella per questo tipo di pagine nel database.',
    'pages'     => 'Lo slug è utilizzato per creare l\'URL della pagina.',
    ],
    ],
    'meta_title' => [
        'name'     => 'Meta Title',
    'instructions' => 'Specifica un titolo in ottica SEO.',
    'warning'      => 'Il titolo della pagina viene utilizzato come opzione di default.',
    ],
    'meta_description' => [
        'name'     => 'Meta description',
    'instructions' => 'Specifica una descrizione in ottica SEO.',
    ],
    'name' => [
        'name'     => 'Nome',
    'instructions' => 'Indica un breve ma descrittivo nome per questo tipo di pagina.',
    ],
    'description' => [
        'name'     => 'Descrizione',
    'instructions' => 'Descrivi brevemente questo tipo di pagina.',
    ],
    'theme_layout' => [
        'name'     => 'Layout Tema',
    'instructions' => 'Indica il layout da utilizzare per mostrare il contenuto della pagina.',
    ],
    'layout' => [
        'name'     => 'Layout di Pagina',
    'instructions' => 'Il layout utilizzato per mostrare il contenuto della pagina.',
    ],
    'allowed_roles' => [
        'name'     => 'Ruoli consentiti',
    'instructions' => 'Indica quali ruoli possono accedere a questa pagina.',
    'warning'      => 'Se non viene specificato nessun ruolo chiunque potrà accedere alla pagina.',
    ],
    'visible' => [
        'name'     => 'Visibile',
    'label'        => 'Mostrare questa pagina nel menu?',
    'instructions' => 'Disabilita per nascondere questa pagina dalla struttura base del menu.',
    'warning'      => 'Questo potrebbe avere effetti indesiderati in base a come è stato costruito il sito.',
    ],
    'exact' => [
        'name'     => 'Corrispondenza esatta URI',
    'label'        => 'Richiede una corrispondenza esatta con l\'URI',
    'instructions' => 'Disabilita per consentire parametri personalizzati.',
    ],
    'enabled' => [
        'name'     => 'Abilita',
    'label'        => 'Questa pagina è abilitata?',
    'instructions' => 'Se disabilitata puoi comunque accedere alla sua preview con il link del Pannello di Controllo.',
    'warning'      => 'Questa pagina deve essere abilitata prima di essere visibile al pubblico.',
    ],
    'home' => [
        'name'     => 'Home page',
    'label'        => 'Questa è la Home Page?',
    'instructions' => 'La home page è la pagina iniziare del sito.',
    ],
    'parent' => [
        'name' => 'Genitore',
    ],
    'handler' => [
        'name'     => 'Handler',
    'instructions' => 'Il page handler è responsabile per la creazione della risposta HTTP della pagina.',
    ],
    'content' => [
        'name' => 'Contenuto',
    ],
];
