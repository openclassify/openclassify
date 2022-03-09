<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'types'      => 'Geben Sie einen kurzen, beschreibenden Namen für diesen Beitragstyp an.',
            'categories' => 'Geben Sie einen kurzen, beschreibenden Namen für diese Kategorie an.',
        ],
    ],
    'title'            => [
        'name'         => 'Titel',
        'instructions' => 'Geben Sie einen kurzen, beschreibenden Titel für diesen Beitrag an.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types'      => 'Die Slug wird verwendet, um die Datenbanktabelle für Beiträge dieses Typs zu erstellen.',
            'categories' => 'Die Slug wird verwendet um die Kategorie-URLs zu erzeugen.',
            'posts'      => 'Die Slug wird verwendet um die Beitrags-URLs zu erzeugen.',
        ],
    ],
    'description'      => [
        'name'         => 'Beschreibung',
        'instructions' => [
            'types'      => 'Beschreiben Sie kurz den Beitragstyp.',
            'categories' => 'Beschreiben Sie kurz die Kategorie.',
        ],
        'warning'      => 'Je nachdem, wie Ihre Website erstellt wurde, wird diese möglicherweise öffentlich angezeigt.',
    ],
    'summary'          => [
        'name'         => 'Zusammenfassung',
        'instructions' => 'Schreibe eine kurze Zusammenfassung, um diesen Beitrag vorzustellen.',
    ],
    'category'         => [
        'name'         => 'Kategorie',
        'instructions' => 'Wählen Sie aus, zu welcher Kategorie dieser Beitrag gehört.',
    ],
    'meta_title'       => [
        'name'         => 'Meta-Titel',
        'instructions' => 'Geben Sie den Meta-Titel (SEO) an.',
        'warning'      => 'Wenn Sie keinen Meta-Titel festlegen wird der Beitragstitel verwendet.',
    ],
    'meta_description' => [
        'name'         => 'Meta-Beschreibung',
        'instructions' => 'Geben Sie die Meta-Beschreibung (SEO) an.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Geben Sie das Theme Layout an, in welches das <strong>Beitragslayout</strong> eingebettet werden soll.',
    ],
    'layout'           => [
        'name'         => 'Beitrag Layout',
        'instructions' => 'Das Layout wird für den Inhalt des Beitrags verwendet.',
    ],
    'tags'             => [
        'name'         => 'Schlagwörter',
        'instructions' => 'Geben Sie Schlagwörter an, um die Gruppierung Ihres Beitrags mit anderen zu erleichtern.',
    ],
    'enabled'          => [
        'name'         => 'Aktiviert',
        'label'        => 'Ist dieser Beitrag aktiviert?',
        'instructions' => 'Wenn diese Option deaktiviert ist, können Sie weiterhin die Vorschau im Control Panel nutzen.',
        'warning'      => 'Dieser Beitrag muss aktiviert sein, bevor er <strong>öffentlich</strong> angezeigt werden kann.',
    ],
    'featured'         => [
        'name'         => 'Hervorgehoben',
        'label'        => 'Ist dies ein hervorgehobener Beitrag?',
        'instructions' => 'Hervorgehobene Beiträge können besonders prominent dargestellt werden.',
        'warning'      => 'Je nachdem, wie Ihre Website erstellt wurde, kann diese Einstellung Auswirkungen haben oder auch nicht.',
    ],
    'publish_at'       => [
        'name'         => 'Veröffentlicht am',
        'instructions' => 'Geben Sie den Veröffentlichungszeitpunkt für diesen Beitrag an.',
        'warning'      => 'Wenn der Zeitpunkt in der Zukunft liegt, wird dieser Beitrag bis dahin nicht öffentlich sichtbar sein.',
    ],
    'author'           => [
        'name'         => 'Autor',
        'instructions' => 'Geben Sie den öffentlich angezeigten Autor dieses Beitrags an.',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'live'      => 'Live',
            'draft'     => 'Entwurf',
            'scheduled' => 'Geplant',
        ],
    ],
    'content'          => [
        'name' => 'Inhalt',
    ],
];
