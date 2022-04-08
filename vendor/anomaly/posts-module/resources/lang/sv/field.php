<?php

return [
    'name'             => [
        'name'         => 'Namn',
        'instructions' => 'Skriv ett läggidentiferat namn.',
    ],
    'title'            => [
        'name'         => 'Titel',
        'instructions' => 'Skriv in inläggets titel.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => 'Sluggen används för att bygga länkens URL.',
    ],
    'description'      => [
        'name'         => 'Beskrivning',
        'instructions' => 'Beskriv inlägget kortfattat.',
    ],
    'summary'          => [
        'name'         => 'Sammanfattning',
        'instructions' => 'Skirv en kortfattad sammanfattning över inlägget.',
    ],
    'category'         => [
        'name'         => 'Kategori',
        'instructions' => 'Specificiera vilken kategori detta inlägget tillhör.',
    ],
    'meta_title'       => [
        'name'         => 'Metatitel',
        'instructions' => 'Skriv inläggets SEO-titel. Inläggets titel kommer att användas som standard.',
    ],
    'meta_description' => [
        'name'         => 'Metabeskrivning',
        'instructions' => 'Skriv inläggets SEO-beskrivning.',
    ],
    'theme_layout'     => [
        'name'         => 'Temalayout',
        'instructions' => 'Temalayouten används runtomkring inläggets innehåll.',
    ],
    'layout'           => [
        'name'         => 'Layout',
        'instructions' => 'Layouten används för att visa inläggets innehåll.',
    ],
    'css'              => [
        'name'         => 'CSS',
        'instructions' => 'Denna CSS kommer att bli tillagt till <strong>styles.css</strong>.',
    ],
    'js'               => [
        'name'         => 'JS',
        'instructions' => 'Detta skript kommer att bli tillagt till <strong>scripts.js</strong>.',
    ],
    'tags'             => [
        'name'         => 'Taggar',
        'instructions' => 'Lägg till organiserande taggar (separeras med blanksteg).',
    ],
    'enabled'          => [
        'name'         => 'Offentligt',
        'label'        => 'Är detta inlägg offentligt?',
        'instructions' => 'Detta inlägget kommer inte att visas förrän det har offentliggjorts och publiceringsdatumet uppnått.',
    ],
    'featured'         => [
        'name'         => 'Upplyft',
        'label'        => 'Är detta ett upplyft inlägg?',
        'instructions' => 'Upplyft inlägg kan användas för att göra ett inlägg mer speciellt än alla andra.',
    ],
    'publish_at'       => [
        'name'         => 'Publiceringsdatum',
        'instructions' => 'Ställ in vilket datum och tid som inlägget ska publiceras.',
    ],
    'author'           => [
        'name'         => 'Författare',
        'instructions' => 'Ställ in vem som ska vara inläggets författare.',
    ],
    'allow_comments'   => [
        'name'         => 'Kommentarer är tillåtna',
        'label'        => 'Ska kommentarer tillåtas för detta inlägget?',
        'instructions' => 'Som standard så måste kommentarer godkännas innan de publiceras.',
    ],
    'ttl'              => [
        'label'        => 'Time to live (TTL)',
        'instructions' => 'Hur lång tid (i minuter) vill du att inlägget ska cachas innan uppdatering sker?',
    ],
];
