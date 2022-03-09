<?php

return [
    'name'            => [
        'label'        => 'Svetainės pavadinimas',
        'instructions' => 'Koks yra jūsų projekto pavadinimas?',
        'placeholder'  => 'distribution::addon.name',
    ],
    'description'     => [
        'label'        => 'Svetainės aprašymas',
        'instructions' => 'Koks jūsų projekto aprašymas arba šūkis?',
        'placeholder'  => 'distribution::addon.description',
    ],
    'business'        => [
        'label'        => 'Verslo pavadinimas',
        'instructions' => 'Koks jūsų įmonės juridinis pavadinimas?',
    ],
    'phone'           => [
        'label'        => 'Kontaktinis telefonas',
        'instructions' => 'Nurodykite bendrąjį kontaktinio telefono numerį.',
    ],
    'address'         => [
        'label' => 'Adresas',
    ],
    'address2'        => [
        'label' => 'apartamentai, korpusas ir t.t.',
    ],
    'city'            => [
        'label' => 'Miestas',
    ],
    'state'           => [
        'label' => 'Valstija/Rajonas',
    ],
    'postal_code'     => [
        'label' => 'Pašto kodas',
    ],
    'country'         => [
        'label' => 'Šalis',
    ],
    'timezone'        => [
        'label'        => 'Laiko juostos zona',
        'instructions' => 'Nurodykite numatytąją svetainės laiko juostą.',
    ],
    'unit_system'     => [
        'label'        => 'Vienetų sistema',
        'instructions' => 'Nurodykite savo svetainės vienetą.',
        'option'       => [
            'imperial' => 'Imperijos sistema',
            'metric'   => 'Metrinė sistema',
        ],
    ],
    'currency'        => [
        'label'        => 'Valiuta',
        'instructions' => 'Nurodykite numatytąją valiutą svetainės',
    ],
    'date_format'     => [
        'label'        => 'Datos formatas',
        'instructions' => 'Nurodykite numatytąjį datos formatą',
    ],
    'time_format'     => [
        'label'        => 'Laiko formata',
        'instructions' => 'Nurodykite numatytąjį laiko formatą',
    ],
    'default_locale'  => [
        'label'        => 'Kalba',
        'instructions' => 'Nurodykite numatytąją kalbą',
    ],
    'enabled_locales' => [
        'label'        => 'Galimos kalbos',
        'instructions' => 'Nurodykite, kokios kalbos jūsų svetainėje yra.',
    ],
    'maintenance'     => [
        'label'        => 'Priežiūros režimas',
        'instructions' => 'Naudokite šią parinktį, kad išjungtumėte viešąją sistemos dalį.
Tai yra naudinga, kai norite išjungti svetainę, kad atliktumėte techninę priežiūrą ar plėtrą.',
    ],
    'debug'           => [
        'label'        => 'Derinimo režimas',
        'instructions' => 'Kai įjungta, išsamūs pranešimai bus rodomi klaidomis.',
    ],
    'ip_whitelist'    => [
        'label'        => 'IP baltasis sąrašas',
        'instructions' => 'Kai įjungtas priežiūros režimas, šiems IP adresams bus leista peržiūrėti svetainę.',
        'placeholder'  => 'Atskirkite kiekvieną IP adresą kableliu.',
    ],
    'basic_auth'      => [
        'label'        => 'Greitas autentifikavimas',
        'instructions' => 'Kai įjungtas palaikymo režimas, ar greiti vartotojai gali atlikti HTTP autentifikavimą?',
    ],
    '503_message'     => [
        'label'        => 'Nepasiekiamas pranešimas',
        'instructions' => 'Kai svetainė yra išjungta arba yra didelė problema, šis pranešimas bus rodomas vartotojams.',
        'placeholder'  => 'Sugrįžkite vėliau.',
    ],
    'email'           => [
        'label'        => 'Sistemos el.paštas',
        'instructions' => 'Nurodykite numatytąjį el. pašto adresą, kuris bus naudojamas sistemos sukurtiems pranešimams.',
        'placeholder'  => 'vardas@pavadinimas.lt',
    ],
    'sender'          => [
        'label'        => 'Siuntėjo pavadinimas',
        'instructions' => 'Nurodykite pavadinimą &quot;Nuo ko&quot;, kuris naudojamas sistemos sukurtiems pranešimams.',
    ],
    'standard_theme'  => [
        'label'        => 'Viešoji tema',
        'instructions' => 'Kokią temą norėtumėte naudoti viešai svetainėje?',
    ],
    'admin_theme'     => [
        'label'        => 'Administratoriaus tema',
        'instructions' => 'Kokią temą norėtumėte naudoti valdymo skydui?',
    ],
    'per_page'        => [
        'label'        => 'Rezultatai puslapyje',
        'instructions' => 'Nurodykite numatytą rezultatų skaičių, kuris bus rodomas viename puslapyje.',
    ],
];
