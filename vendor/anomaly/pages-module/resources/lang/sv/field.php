<?php

return [
    'title'                 => [
        'name'         => 'Titel',
        'instructions' => 'Vad är sidans titel?',
    ],
    'slug'                  => [
        'name'         => 'Slug',
        'instructions' => 'Sluggen används för att bygga sidans URL.',
    ],
    'meta_title'            => [
        'name'         => 'Metatitel',
        'instructions' => 'Skriv in sidans SEO-titel. Som standard kommer sidans vanliga titel att användas.',
    ],
    'meta_description'      => [
        'name'         => 'Metabeskrivning',
        'instructions' => 'Skriv in sidans SEO-beskrivning.',
    ],
    'ttl'                   => [
        'name'         => 'TTL',
        'label'        => 'Time to live (TTL)',
        'instructions' => 'Hur lång tid (i minuter) vill du att sidan ska cachas innan uppdatering sker?',
    ],
    'css'                   => [
        'name'         => 'CSS',
        'instructions' => 'CSS:en kommer att läggas till i <strong>styles.css</strong>.',
    ],
    'js'                    => [
        'name'         => 'JS',
        'instructions' => 'Skriptet kommer att läggas till i <strong>scripts.js</strong>.',
    ],
    'name'                  => [
        'name'         => 'Namn',
        'instructions' => 'Vad är namnet för sidtypen?',
    ],
    'description'           => [
        'name'         => 'Beskrivning',
        'instructions' => 'Beskriv kortfattat sidtypen.',
    ],
    'theme_layout'          => [
        'name'         => 'Temalayout',
        'instructions' => 'Temalayouten kommer att användas runtomkring sidans innehåll.',
    ],
    'layout'                => [
        'name'         => 'Layout',
        'instructions' => 'Layout kommer att användas för att visa sidans innehåll.',
    ],
    'allowed_roles'         => [
        'name'         => 'Tillåtna Roller',
        'instructions' => 'Vilka användarroller har tillåtelse att läsa denna sidan?',
    ],
    'enabled'               => [
        'name'         => 'Offentlig',
        'label'        => 'Är sidan offentlig?',
        'instructions' => 'Sidan kommer inte vara synlig tills den är markerad som offentlig.',
    ],
    'home'                  => [
        'name'         => 'Förstasida',
        'label'        => 'Är detta förstasidan?',
        'instructions' => 'Förstasidan är landningssidan för webbplatsen.',
    ],
    'parent'                => [
        'name'         => 'Förälder',
        'instructions' => 'Välj en föräldersida om någon önskas.',
    ],
    'handler'               => [
        'name'         => 'Sidhanteraren',
        'instructions' => 'Sidhanteraren ansvarar över att bygga HTTP-svaret för en sida.',
    ],
    'route_suffix'          => [
        'name'         => 'Sökvägsuffix',
        'instructions' => 'Detta kommer att läggas till efter sökvägen när sökvägsfilen kompileras.',
        'placeholder'  => '{slug}/{exempel}',
    ],
    'route_constraints'     => [
        'name'         => 'Sökvägskrav',
        'instructions' => 'Specificiera sökvägskraven här som ett YAML-fält av <code>paramter: krav</code>.',
        'placeholder'  => 'slug: [A-Za-z]+',
    ],
    'additional_parameters' => [
        'name'         => 'Ytterligare Parametrar',
        'instructions' => 'Specificiera ytterligare sökfrågeparamtrar som ett YAML-fält av <code>nyckel: värde</code>.',
        'placeholder'  => 'nyckel: värde',
    ],
];
