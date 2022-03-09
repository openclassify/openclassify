<?php

return [
    'field'        => [
        'name'         => 'Champs',
        'label'        => 'Champs',
        'instructions' => 'Choisissez un champs à assigner.'
    ],
    'label'        => [
        'name'         => 'Label',
        'instructions' => 'Le label est utilisé uniquement pour les formulaires. Si laissé vide le nom du champs sera utilisé.'
    ],
    'required'     => [
        'name'         => 'Requis',
        'label'        => 'Est-ce que ce champs est requis ?',
        'instructions' => 'Si le champs est requis il doit toujours être renseigné.'
    ],
    'unique'       => [
        'name'         => 'Unique',
        'label'        => 'Est-ce que ce champs est unique ?',
        'instructions' => 'Si le champs est unique il ne peut pas être rempli deux fois avec la même valeur.'
    ],
    'placeholder'  => [
        'name'         => 'Placeholder',
        'instructions' => 'Le placeholder permet d\'indiquer une valeur par défaut au champs.'
    ],
    'translatable' => [
        'name'         => 'Peut être traduit',
        'label'        => 'Est-ce que ce champs peut être traduit ?',
        'instructions' => 'Si le champs peut être traduit il sera disponible dans toutes les langues.'
    ],
    'instructions' => [
        'name'         => 'Instructions',
        'instructions' => 'Instructions personnalisée pour remplir le champs.'
    ],
    'warning'      => [
        'name'         => 'Avertissement',
        'instructions' => 'Un avertissement permet de mettre en avant une information importante.'
    ]
];
