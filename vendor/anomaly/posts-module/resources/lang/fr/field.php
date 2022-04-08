<?php

return [
    'name'             => [
        'name'         => 'Nom',
        'instructions' => [
            'types'      => 'Entrez un nom pour ce type d\'article.',
            'categories' => 'Entrez un nom pour cette catégorie.',
        ],
    ],
    'title'            => [
        'name'         => 'Titre',
        'instructions' => 'Entrez un titre pour cet article.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types'      => 'Le slug est utilisé pour nommer la table en base de données.',
            'categories' => 'Le slug est utilisé dans l\'URL de la catégorie.',
            'posts'      => 'Le slug est utilisé dans l\'URL de l\'article.',
        ],
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'types'      => 'Décrivez le type d\'article.',
            'categories' => 'Décrivez la catégorie.',
        ],
        'warning'      => 'Ceci peut ne pas être afficher publiquement, dépendament de la façon dont le site est développé.',
    ],
    'summary'          => [
        'name'         => 'Introduction',
        'instructions' => 'Entrez un bref descriptif pour cet article.',
    ],
    'category'         => [
        'name'         => 'Catégorie',
        'instructions' => 'Choisissez la catégorie à laquelle cet article appartient.',
    ],
    'meta_title'       => [
        'name'         => 'Méta Titre',
        'instructions' => 'Entrez le titre pour la SEO.',
        'warning'      => 'Si laissé vide, le titre de l\'article est utilisé.',
    ],
    'meta_description' => [
        'name'         => 'Méta Description',
        'instructions' => 'Entrez une description SEO.',
    ],
    'theme_layout'     => [
        'name'         => 'Layout du thème',
        'instructions' => 'Choisissez le layout du thème à utiliser pour afficher l\'article.',
    ],
    'layout'           => [
        'name'         => 'Layout de l\'article',
        'instructions' => 'Spécifiez un layout d\'article à utiliser pour afficher son contenu.',
    ],
    'tags'             => [
        'name'         => 'Tags',
        'instructions' => 'Choisissez des tags pour votre article. Les tags aident à organiser ensemble les articles sur le site.',
    ],
    'enabled'          => [
        'name'         => 'Actif',
        'label'        => 'Est-ce que l\'article est activé ?',
        'instructions' => 'Si désactivé, l\'article pourra être consulté via le lien de prévisualisation.',
        'warning'      => 'L\'article doit être activé pour être consultable publiquement.',
    ],
    'featured'         => [
        'name'         => 'Epinglé',
        'label'        => 'Est-ce que l\'article est épinglé ?',
        'instructions' => 'Les articles épinglés permettent de mettre en avant certains contenus à vos visiteurs.',
        'warning'      => 'Cet option peut ne pas avoir d\'effet dépendament de la façon dont le site est développé.',
    ],
    'publish_at'       => [
        'name'         => 'Date de publication',
        'instructions' => 'Choisissez une date de publication pour cet article.',
        'warning'      => 'Si la date est future, l\'article ne sera visible qu\'à partir de cette dernière.',
    ],
    'author'           => [
        'name'         => 'Auteur',
        'instructions' => 'Choisissez l\'auteur qui sera publiquement associé à cet article.',
    ],
    'status'           => [
        'name'   => 'Statut',
        'option' => [
            'live'      => 'En ligne',
            'draft'     => 'Brouillon',
            'scheduled' => 'Programmé',
        ],
    ],
    'content'          => [
        'name' => 'Contenu',
    ],
];
