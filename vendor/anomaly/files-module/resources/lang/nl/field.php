<?php

return [
    'name'          => [
        'name'         => 'Naam',
        'instructions' => [
            'disks'   => 'Voer een korte naam in voor de disk.',
            'folders' => 'Voer een korte naam in voor de map.',
            'files'   => 'Voer een naam in voor dit bestand.',
        ],
    ],
    'title'         => [
        'name'         => 'Titel',
        'instructions' => 'Specify a short descriptive title for this file. ',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'De slug wordt gebruikt voor het bouwen van de opslag locatie.',
    ],
    'size'          => [
        'name' => 'Grootte',
    ],
    'disk'          => [
        'name'         => 'Disk',
        'instructions' => 'Kies bij welke disk deze map hoort.',
    ],
    'folder'        => [
        'name' => 'Map',
    ],
    'adapter'       => [
        'name' => 'Adapter',
    ],
    'keywords'      => [
        'name'         => 'Keywords',
        'instructions' => 'Voer organiseerbare keywords in om het groeperen van bestanden te verbeteren.',
    ],
    'mime_type'     => [
        'name' => 'MIME Type',
    ],
    'preview'       => [
        'name' => 'Preview',
    ],
    'description'   => [
        'name'         => 'Omschrijving',
        'instructions' => [
            'disks'  => 'Beschrijf in het kort deze disk.',
            'folder' => 'Beschrijf in het kort deze map.',
            'files'  => 'Beschrijf in het kort dit bestand.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'Toegestane typen',
        'instructions' => 'Geef aan welke bestand type extensies toegestaan zijn in deze map.',
        'warning'      => 'Let op kleine verschillen tussen mime types, zoals jpg en jpeg.',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
    'alt_text'      => [
        'name'         => 'Alt Tekst',
        'instructions' => 'Specificeer de alt tekst voor een afbeelding',
        'warning'      => 'De gehumaniseerde bestandsnaam wordt normaal gebruikt als fallback.',
    ],
    'caption'       => [
        'name'         => 'Onderschrift',
        'instructions' => 'Specificeer een onderschrift voor een afbeelding.',
    ],
];
