<?php

return [
    'title'            => [
        'name'         => 'Titel',
        'instructions' => 'Voer een korte omschrijving in voor deze pagina.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types' => 'De slug wordt gebruikt voor het maken van de database tabel voor pagina\'s van dit type.',
            'pages' => 'De slug wordt gebruikt voor de pagina URL.',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Voer de SEO titel in.',
        'warning'      => 'De pagina titel zal standaard worden gebruikt.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Voer de SEO omschrijving in.',
    ],
    'meta_keywords'    => [
        'name'         => 'Meta Keywords',
        'instructions' => 'Voer de SEO keywords in.',
    ],
    'name'             => [
        'name'         => 'Naam',
        'instructions' => 'Voer een korte omschrijving in voor dit paginatype.',
    ],
    'description'      => [
        'name'         => 'Omschrijving',
        'instructions' => 'Beschrijf in het kort dit paginatype.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Kies de theme layout voor deze pagina layout.',
    ],
    'layout'           => [
        'name'         => 'Pagina Layout',
        'instructions' => 'De layout dat wordt gebruikt voor de pagina content.',
    ],
    'allowed_roles'    => [
        'name'         => 'Toegestaande gebruikersrollen',
        'instructions' => 'Kies welke gebruikersrollen deze pagina kunnen wijzigen.',
        'warning'      => 'Als er geen gebruikersrollen worden gekozen kan iedereen deze pagina aanpassen.',
    ],
    'visible'          => [
        'name'         => 'Zichtbaar',
        'label'        => 'Weergeef deze pagina in de navigatie?',
        'instructions' => 'Schakel uit om deze pagina niet in de standaard navigatie te laten zien.',
        'warning'      => 'Dit kan een negatief effect hebben, afhankelijk van hoe de website is gebouwd.',
    ],
    'exact'            => [
        'name'         => 'Exacte URI',
        'label'        => 'Is een exacte URI match nodig?',
        'instructions' => 'Schakel uit om custom parameters die de URI van deze pagina volgen toe te staan.',
    ],
    'enabled'          => [
        'name'         => 'Ingeschakeld',
        'label'        => 'Is deze pagina ingeschakeld?',
        'instructions' => 'Als dit is uitgeschakeld kan men nog steeds de pagina via een veilige link bekijken in het control panel.',
        'warning'      => 'Deze pagina moet ingeschakeld zijn voor het <strong>publiekelijk</strong> bekeken kan worden.',
    ],
    'home'             => [
        'name'         => 'Homepagina',
        'label'        => 'Is dit de homepagina?',
        'instructions' => 'De homepagina is de standaard landingspagina voor de website.',
    ],
    'parent'           => [
        'name' => 'Parent',
    ],
    'handler'          => [
        'name'         => 'Handler',
        'instructions' => 'De pagina handler is verantwoordelijk voor het bouwen van de gehele HTTP response voor een pagina.',
    ],
    'content'          => [
        'name' => 'Content',
    ],
    'path'             => [
        'name' => 'Pad',
    ],
];
