<?php

return [
    'type'       => [
        'label'        => 'Addon-Typ',
        'instructions' => 'Welche Typen von Addons möchten Sie einbeziehen?',
        'placeholder'  => 'Alle Typen',
    ],
    'search'     => [
        'label'        => 'Suche in Erweiterungen',
        'instructions' => 'Wenn der "Erweiterungen" Addon-Typ ausgewählt wurde, können Sie hier optional einen Suchbegriff eingeben, um nur Erweiterungen die einen spezifischen Service bieten einzuschliessen.',
        'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'        => 'Themes Typ',
        'instructions' => 'Wenn der "Themes" Addon-Typ ausgewählt wurde, können Sie hier die Anzeige von Admin oder öffentlichen Themes einschränken.',
        'placeholder'  => 'Admin + Öffentlich',
        'admin'        => 'Admin',
        'public'       => 'Öffentlich',
    ],
];
