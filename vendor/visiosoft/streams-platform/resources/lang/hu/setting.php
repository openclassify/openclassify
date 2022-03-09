<?php

return [
    'name' => [
        'label' => 'Oldal Neve',
    'instructions' => 'Mi a neve a weboldalnak?',
    ],
    'description' => [
        'label' => 'Oldal Leírása',
    'instructions' => 'Mi az oldal leírása vagy szlogenje:',
    ],
    'business' => [
        'label' => 'Cég neve',
    'instructions' => 'Mi a cég hivatalos neve?',
    ],
    'phone' => [
        'label' => 'Kapcsolatfelvételi telefonszám',
    'instructions' => 'Határozz meg egy kapcsolatfelvételi telefonszámot',
    ],
    'address' => [
        'label' => 'Cím',
    ],
    'address2' => [
        'label' => 'Cím kiegészítés',
    ],
    'city' => [
        'label' => 'Város',
    ],
    'state' => [
        'label' => 'Megye',
    ],
    'postal_code' => [
        'label' => 'Irányítószám',
    ],
    'country' => [
        'label' => 'Ország',
    ],
    'timezone' => [
        'label' => 'Időzóna',
    'instructions' => 'Határozd meg az oldal alapértelmezett időzónáját',
    ],
    'unit_system' => [
        'label' => 'Mértékegység rendszer',
    'instructions' => 'Határozd meg az oldal mértékegységrendszerét.',
    'option' => [
        'imperial' => 'Britt mértékegységrendszer',
    'metric' => 'SI mértékegységrendszer',
    ],
    ],
    'currency' => [
        'label' => 'Pénznem',
    'instructions' => 'Határozd meg az oldal pénznemét.',
    ],
    'date_format' => [
        'label' => 'Dátum formátum',
    'instructions' => 'Határozd meg az oldal dátumformátumát.',
    ],
    'time_format' => [
        'label' => 'Idő formátum',
    'instructions' => 'Határozd meg az oldal időformátumát.',
    ],
    'default_locale' => [
        'label' => 'Nyelv',
    'instructions' => 'Határozd meg az alapértelmezett nyelvet.',
    ],
    'enabled_locales' => [
        'label' => 'Engedélyezett nyelvek',
    'instructions' => 'Határozd meg, hogy melyik nyelvek legyenek elérhetőek az oldaladon.',
    ],
    'maintenance' => [
        'label' => 'Karbantartás mód',
    'instructions' => 'Használd ezt az opciót, hogy ha korlátozni akarod az oldal publikus elérhetőségét, karbantartás vagy fejlesztés miatt.',
    ],
    'debug' => [
        'label' => 'Hibakereső mód',
    'instructions' => 'Ha engedélyezett részletesebb hibaüzenetek jelennek meg.',
    ],
    'ip_whitelist' => [
        'label' => 'IP Fehérlista',
    'instructions' => 'Karbantartási módban az IP címekről elérhető a weboldal felülete.',
    'placeholder' => 'Az IP címeket vesszővel válaszd el.',
    ],
    'basic_auth' => [
        'label' => 'Bejelentkezés kérése?',
    'instructions' => 'Karbantartás módban a rendszer léptesse be a felhasználót?',
    ],
    '503_message' => [
        'label' => 'Nem elérhető üzenet',
    'instructions' => 'Ha az oldal le van tiltva, vagy nagyobb probléma miatt nem jelenik meg ez az üzenet jelenik meg.',
    'placeholder' => 'Hamarosan visszatérünk...',
    ],
    'email' => [
        'label' => 'Rendszer Email',
    'instructions' => 'Határozd meg a rendszer email címet, melyre  a rendszer által generált üzenetek mennek.',
    'placeholder' => 'pelda@goweb.hu',
    ],
    'sender' => [
        'label' => 'Küldő neve',
    'instructions' => 'Határozd meg a küldő nevét rendszerüzenet küldéséhez.',
    ],
    'mail_driver' => [
        'label' => 'Email Meghajtó',
    'instructions' => 'Hogyan küldjön a rendszer emailt?',
    'option' => [
        'smtp' => 'SMTP',
    'mail' => 'PHP Mail',
    'sendmail' => 'Sendmail',
    'mailgun' => 'Mailgun',
    'log' => 'Log Fájl',
    'ses' => 'Amazon SES',
    ],
    ],
    'mail_host' => [
        'label' => 'SMTP Hoszt',
    'instructions' => 'Határozd meg az SMTP szerver címét levélküldéshez.',
    'placeholder' => 'smtp.goweb.hu',
    ],
    'mail_port' => [
        'label' => 'SMTP Port',
    'instructions' => 'Határozd meg az SMTP portot a levélküldéshez.',
    'placeholder' => '587',
    ],
    'mail_username' => [
        'label' => 'SMTP Felhasználónév',
    'instructions' => 'Határozd meg az SMT P felhasználónevét a levélküldéshez',
    ],
    'mail_password' => [
        'label' => 'SMTP Jelszü',
    'instructions' => 'Határozd meg a SMTP jelszót a levélküldéshez.',
    ],
    'mail_debug' => [
        'label' => 'Levél Hibakeresés',
    'instructions' => 'Ha bekapcsolod a rendszer nem küld emailokat, hanem a logfájlokba írja be az üzeneteket.',
    ],
    'mailgun_domain' => [
        'label' => 'Mailgun Domain',
    ],
    'mailgun_secret' => [
        'label' => 'Mailgun Secret',
    ],
    'mandrill_secret' => [
        'label' => 'Mandrill Secret

',
    ],
    'cache_driver' => [
        'label' => 'Gyorsítótár Meghajtó',
    'instructions' => 'Hogyan tárolja a rendszer a gyorsítótárazott adatokat?',
    'option' => [
        'apc' => 'APC',
    'array' => 'Tömb',
    'file' => 'Fájl',
    'memcached' => 'Memcached',
    'redis' => 'Redis',
    ],
    ],
    'standard_theme' => [
        'label' => 'Publikus Téma',
    'instructions' => 'Melyik témát szeretnéd az oldal publikus felületére?',
    ],
    'admin_theme' => [
        'label' => 'Admin Téma',
    'instructions' => 'Melyik témát szeretnéd az oldal adminisztrációs felületére?',
    ],
    'per_page' => [
        'label' => 'Találatok Oldalanként',
    'instructions' => 'Határozd meg, hogy mennyi találat látszon egy oldalon',
    ],
];
