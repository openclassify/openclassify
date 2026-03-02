<?php

return [
    'related'    => [
        'label'        => 'Relaterad ström',
        'instructions' => 'Ange relaterade strömposter som ska visas i rullgardinsmenyn.',
    ],
    'mode'       => [
        'label'  => 'Ingångsläge',
        'option' => [
            'tags'       => 'Taggar',
            'lookup'     => 'Slå upp',
            'checkboxes' => 'Kryssrutor',
        ],
    ],
    'min'        => [
        'label'        => 'Minsta val',
        'instructions' => 'Ange det minsta antalet tillåtna val.',
    ],
    'max'        => [
        'label'        => 'Maximala val',
        'instructions' => 'Ange det maximala antalet tillåtna val.',
    ],
    'title_name' => [
        'label'        => 'Titelfält',
        'placeholder'  => 'förnamn',
        'instructions' => 'Ange <strong>slug</strong> i fältet som ska visas för rullgardins- / sökalternativ.<br>Du kan ange tolkbara titlar som <strong>{entry.first_name} {entry.last_name}</strong><br>Den relaterade strömens titelkolumn används som standard.',
    ],
];
