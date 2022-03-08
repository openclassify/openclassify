<?php

return [
    'name'          => [
        'name'         => 'Nome',
        'instructions' => [
            'disks'   => 'Indica un breve ma descrittivo nome per il disco.',
            'folders' => 'Indica un breve ma descrittivo nome per la cartella.',
            'files'   => 'Indica il nome del file.',
        ],
    ],
    'title'         => [
        'name'         => 'Titolo',
        'instructions' => 'Indica un breve ma descrittivo titolo per il file.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Lo slug sarà usato per creare la destinazione di salvataggio.',
    ],
    'size'          => [
        'name' => 'Dimensione',
    ],
    'disk'          => [
        'name'         => 'Disco',
        'instructions' => 'Scegli a quale disco assegnare la cartella.',
    ],
    'folder'        => [
        'name' => 'Cartella',
    ],
    'adapter'       => [
        'name' => 'Adapter',
    ],
    'keywords'      => [
        'name'         => 'Keywords',
        'instructions' => 'Indica delle keywords che ti aiutino a raggruppare i file.',
    ],
    'mime_type'     => [
        'name' => 'MIME Type',
    ],
    'preview'       => [
        'name' => 'Anteprima',
    ],
    'description'   => [
        'name'         => 'Descrizione',
        'instructions' => [
            'disks'  => 'Descrivi brevemente il disco.',
            'folder' => 'Descrivi brevemente la cartella.',
            'files'  => 'Descrivi brevemente il file.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'Tipi consentiti',
        'instructions' => 'Indica quali tipi di file possono essere caricati in questa cartella.',
        'warning'      => 'Nota: ci sono differenze tra jpg e jpeg',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
];
