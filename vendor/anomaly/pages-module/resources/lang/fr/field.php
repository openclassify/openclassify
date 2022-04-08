<?php

return [
    'title'            => [
        'name'         => 'Titre',
        'instructions' => 'Entrez une titre pour cette page.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types' => 'Le slug est utilisé pour nommer la table en base de données.',
            'pages' => 'Le slug est utilisé pour l\'URL de la page.',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Méta titre',
        'instructions' => 'Entrez le titre SEO de la page.',
        'warning'      => 'Par défaut, le titre de la page sera utilisé.',
    ],
    'meta_description' => [
        'name'         => 'Méta description',
        'instructions' => 'Entrez la description SEO de la page.',
    ],
    'name'             => [
        'name'         => 'Nom',
        'instructions' => 'Entrez un nom décrivant le type de page.',
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => 'Décrivez brièvement le type de page.',
    ],
    'theme_layout'     => [
        'name'         => 'Layout du thème',
        'instructions' => 'Choisissez un layout du thème pour inclure ce type de page.',
    ],
    'layout'           => [
        'name'         => 'Layout de la page',
        'instructions' => 'Le layout à utiliser pour afficher le contenu de la page.',
    ],
    'allowed_roles'    => [
        'name'         => 'Rôles autorisés',
        'instructions' => 'Choisissez le rôles autorisés à consulter la page.',
        'warning'      => 'Si aucun rôle n\'est choisi, tout le monde pourra consulter la page.',
    ],
    'visible'          => [
        'name'         => 'Visibilité',
        'label'        => 'Afficher cette page dans la navigation ?',
        'instructions' => 'Désactivez pour ne pas afficher la page dans la navigation.',
        'warning'      => 'Selon comment votre site est développé, cette option peut ne pas avoir d\'effet.',
    ],
    'exact'            => [
        'name'         => 'URI exacte',
        'label'        => 'Nécéssite une URI exacte pour accèder à la page.',
        'instructions' => 'Désactiver pour autoriser des paramètres supplémentaires dans l\'URL.',
    ],
    'enabled'          => [
        'name'         => 'Active',
        'label'        => 'Est-ce que cette page est active ?',
        'instructions' => 'Si désactivée, vous pourrez toujours y accèder via le lien de prévisualisation.',
        'warning'      => 'La page doit être activée pour être accessible sur la partie publique.',
    ],
    'home'             => [
        'name'         => 'Page d\'accueil',
        'label'        => 'Est-ce que cette page est la page d\'accueil ?',
        'instructions' => 'La page d\'accueil est la page principale de votre site.',
    ],
    'parent'           => [
        'name' => 'Parent',
    ],
    'handler'          => [
        'name'         => 'Handler',
        'instructions' => 'Le Handler gère la construction de la réponse HTTP.',
    ],
    'content'          => [
        'name' => 'Contenu',
    ],
];
