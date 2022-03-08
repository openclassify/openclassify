<?php

return [
    'related'    => [
        'label'        => 'Liittyvä virta',
        'instructions' => 'Määritä liittyvät stream-merkinnät näytettäväksi pudotusvalikossa.',
    ],
    'mode'       => [
        'label'  => 'Tulotila',
        'option' => [
            'tags'       => 'Tunnisteet',
            'lookup'     => 'Katso ylös',
            'checkboxes' => 'Valintaruudut',
        ],
    ],
    'min'        => [
        'label'        => 'Vähimmäisvalinnat',
        'instructions' => 'Määritä sallittujen valintojen vähimmäismäärä.',
    ],
    'max'        => [
        'label'        => 'Suurin valikoima',
        'instructions' => 'Määritä sallittujen valintojen enimmäismäärä.',
    ],
    'title_name' => [
        'label'        => 'Otsikkokenttä',
        'placeholder'  => 'etunimi',
        'instructions' => 'Määritä avattavien valintojen / hakuvaihtoehtojen yhteydessä näytettävän kentän <strong></strong><br>Voit määrittää jäsennettäviä otsikoita, kuten <strong>{entry.first_name} {entry.last_name}</strong><br>, oletuksena käytetään siihen liittyvän suoran otsikon saraketta.',
    ],
];
