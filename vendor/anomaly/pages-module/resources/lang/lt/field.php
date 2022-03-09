<?php

return [
    'title' => [
        'name' => 'Pavadinimas',
        'instructions' => 'Užvardinkite trumpai ir aiškiai šį puslapį.',
    ],
    'slug' => [
        'name' => 'Slug',
        'instructions' => [
            'types' => 'Šio tipo puslapių duombazėje toks slug jau yra.',
            'pages' => 'Slug naudojamas kuriant puslapio URL.',
        ],
    ],
    'meta_title' => [
        'name' => 'Meta Title',
        'instructions' => 'Pavadinimas  SEO reikmėms.',
        'warning' => 'Puslapio pavadinimas bus naudojamas pagal nutylėjimą.',
    ],
    'meta_description' => [
        'name' => 'Meta Description',
        'instructions' => 'Aprašymas  SEO reikmėms.',
    ],
    'meta_keywords' => [
        'name' => 'Meta keywords',
        'instructions' => 'Raktažodžiai SEO reikmėms',
    ],
    'name' => [
        'name' => 'Vardas',
        'instructions' => 'Užvadinkite trumpai ir aiškiai.',
    ],
    'description' => [
        'name' => 'Aprašymas',
        'instructions' => 'Aprašykite puslapio tipą plačiai.',
    ],
    'theme_layout' => [
        'name' => 'Temos išdėstymas',
        'instructions' => 'Nurodykite temos išdėstymą su kuriuo apjungtas puslapio išdėstymą.',
    ],
    'layout' => [
        'name' => 'Puslapio išdėstymas',
        'instructions' => 'Išdėstymas, kuris naudojamas puslapio turiniui atvaizduoti.',
    ],
    'allowed_roles' => [
        'name' => 'Leidžiamos rolės',
        'instructions' => 'Nurodykite, kurios rolės turi prieigą prie šio puslapio.',
        'warning' => 'Jei rolė nenurodyta tuomet prieigą turės visi.',
    ],
    'visible' => [
        'name' => 'Matomas',
        'label' => 'Rodyti šį puslapį navigacijoje?',
        'instructions' => 'Atjungti puslapį, kad nerodytų navigacijos struktūroje.',
        'warning' => 'Tai gali ir nesuveikti. Priklausomai nuo to kaip jūsų puslapis yra suprogramuotas.',
    ],
    'exact' => [
        'name' => 'Tikslus URI',
        'label' => 'Reikalauti tikslaus URI atitikimo?',
        'instructions' => 'Atjungti individualizuotų puslapio URI parametrų palaikymą.',
    ],
    'enabled' => [
        'name' => 'Įjungtas',
        'label' => 'Ar šis puslapis įjungtas?',
        'instructions' => 'Net jei išjungtas, jūs vis dar galite naudotis saugų peržiūros linką valdymo skydelyje.',
        'warning' => 'Tam, kad šis puslapis būtų viešai matomas, privalo būti įjungtas.',
    ],
    'home' => [
        'name' => 'Namų puslapis',
        'label' => 'Ar tai namų puslapis?',
        'instructions' => 'Namų puslapis yra pirmas puslapis į kurį vartotojas pateks pagal nutylėjimą.',
    ],
    'parent' => [
        'name' => 'Parent',
    ],
    'handler' => [
        'name' => 'Handler',
        'instructions' => 'Šis puslapio tipas yra atsakingas už pilną HTTP apdorojimą šio tipo puslapiams.',
    ],
    'content' => [
        'name' => 'Turinys',
    ],
    'path' => [
        'name' => 'Kelias',
    ],
];
