<?php

return [
    'name'          => [
        'name'         => 'Naam',
        'instructions' => [
            'menus' => 'Voer een korte naam in voor dit menu.',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'De slug wordt gebruikt voor het weergeven van het menu',
    ],
    'description'   => [
        'name'         => 'Omschrijving',
        'instructions' => 'Beschrijf dit menu in het kort.',
    ],
    'target'        => [
        'name'         => 'Doel',
        'instructions' => 'Hoe opent de link wanneer erop wordt geklikt?',
        'option'       => [
            'self'  => 'Open in het huidige venster.',
            'blank' => 'Open in een nieuw venster.',
        ],
    ],
    'class'         => [
        'name'         => 'Class',
        'instructions' => 'Geef een Class in als dit aangegeven is door uw developer.',
    ],
    'allowed_roles' => [
        'name'         => 'Toegestane gebruikersrollen',
        'instructions' => 'Specificeer welke gebruikersrollen deze link kunnen zien.',
        'warning'      => 'Als er geen gebruikersrollen zijn geselecteerd, kan iedereen deze link zien.',
    ],
];
