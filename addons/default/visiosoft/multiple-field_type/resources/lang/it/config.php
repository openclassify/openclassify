<?php

return [
    'related'    => [
        'label'        => 'Stream correlato',
        'instructions' => 'Specificare le voci del flusso correlate da visualizzare nel menu a discesa.',
    ],
    'mode'       => [
        'label'  => 'Modalità di immissione',
        'option' => [
            'tags'       => 'Tag',
            'lookup'     => 'Consultare',
            'checkboxes' => 'Caselle di controllo',
        ],
    ],
    'min'        => [
        'label'        => 'Selezioni minime',
        'instructions' => 'Specificare il numero minimo di selezioni consentite.',
    ],
    'max'        => [
        'label'        => 'Selezioni massime',
        'instructions' => 'Specificare il numero massimo di selezioni consentite.',
    ],
    'title_name' => [
        'label'        => 'Campo del titolo',
        'placeholder'  => 'nome di battesimo',
        'instructions' => 'Specificare lo slug <strong></strong> del campo da visualizzare per le opzioni di menu a discesa / ricerca.<br>È possibile specificare titoli analizzabili come <strong>{entry.first_name} {entry.last_name}</strong><br>La colonna del titolo del flusso correlato verrà utilizzata per impostazione predefinita.',
    ],
];
