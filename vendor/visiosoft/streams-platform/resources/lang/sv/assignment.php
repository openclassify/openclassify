<?php

return [
    'field'        => [
        'name'         => 'Fält',
        'label'        => 'Fält',
        'instructions' => 'Välj vilket fält som ska tilldelas.'
    ],
    'label'        => [
        'name'         => 'Etikett',
        'instructions' => 'Etiketter används endast för formulär. Ifall lämnad blank kommer fältets namn att användas som etikett istället.'
    ],
    'required'     => [
        'name'         => 'Obligatorisk',
        'label'        => 'Är detta fält obligatoriskt?',
        'instructions' => 'Om fältet är obligatoriskt MÅSTE det alltid ha ett värde ifyllt.'
    ],
    'unique'       => [
        'name'         => 'Unikt',
        'label'        => 'Är detta fält unikt?',
        'instructions' => 'Om fältet är unikt så måste värdet vara unikt. D.v.s. att inget annat fält av samma typ kan ha samma värde.'
    ],
    'placeholder'  => [
        'name'         => 'Platshållare',
        'instructions' => 'Om platshhållare stöds kommer platshållaren att synas i inmatningsfältet när inget har skrivits.'
    ],
    'translatable' => [
        'name'         => 'Översättningsbar',
        'label'        => 'Är detta fält översättningsbart?',
        'instructions' => 'Om fältet är översättningsbart kommer fältet vara tillgängligt i alla påslagna lokaliseringar.'
    ],
    'instructions' => [
        'name'         => 'Instruktioner',
        'instructions' => 'Fältets instruktioner kommer visas i formuläret för att hjälpa användaren.'
    ],
    'warning'      => [
        'name'         => 'Varning',
        'instructions' => 'Varningar hjälper till att uppmärksamma viktig information.'
    ]
];
