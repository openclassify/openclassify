<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locale Hint
    |--------------------------------------------------------------------------
    |
    | Define where to look for an i18n locale.
    |
    | true, false, 'domain' or 'uri'
    |
    | If false, you must handle setting the locale yourself.
    | If true, both 'domain' and 'uri' are enabled and will be detected.
    | If 'domain', streams will check your sub-domain for an i18n locale key
    | If 'uri', streams will check your first URI segment for an i18n locale key
    |
    */

    'hint' => env('LOCALE_HINTS', true),

    /*
    |--------------------------------------------------------------------------
    | Enabled Locales
    |--------------------------------------------------------------------------
    |
    | Define an array of locales enabled for translatable input.
    |
    */

    'enabled' => explode(',', env('ENABLED_LOCALES', 'en')),

    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    |
    | The default locale for CONTENT.
    |
    */

    'default' => env('DEFAULT_LOCALE', env('LOCALE', 'en')),

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | In order to enable a locale or translate anything
    | the i18n locale key MUST be in this array.
    |
    */

    'supported' => [
        'en' => [

            'direction' => 'ltr',
        ],
        'fa' => [

            'direction' => 'ltr',
        ],
        'de' => [

            'direction' => 'ltr',
        ],
        'ar' => [

            'direction' => 'rtl',
        ],
        'cs' => [

            'direction' => 'ltr',
        ],
        'el' => [

            'direction' => 'ltr',
        ],
        'es' => [

            'direction' => 'ltr',
        ],
        'et' => [

            'direction' => 'ltr',
        ],
        'fr' => [

            'direction' => 'ltr',
        ],
        'fr-ca' => [

            'direction' => 'ltr',
        ],
        'it' => [

            'direction' => 'ltr',
        ],
        'nl' => [

            'direction' => 'ltr',
        ],
        'sv' => [

            'direction' => 'ltr',
        ],
        'sl' => [

            'direction' => 'ltr',
        ],
        'sme' => [

            'direction' => 'ltr',
        ],
        'pl' => [

            'direction' => 'ltr',
        ],
        'pt' => [

            'direction' => 'ltr',
        ],
        'pt-br' => [

            'direction' => 'ltr',
        ],
        'br' => [

            'direction' => 'ltr',
        ],
        'ru' => [

            'direction' => 'ltr',
        ],
        'zh-cn' => [

            'direction' => 'ltr',
        ],
        'zh-tw' => [

            'direction' => 'ltr',
        ],
        'he' => [

            'direction' => 'ltr',
        ],
        'lt' => [

            'direction' => 'ltr',
        ],
        'fi' => [

            'direction' => 'ltr',
        ],
        'da' => [

            'direction' => 'ltr',
        ],
        'id' => [

            'direction' => 'ltr',
        ],
        'hu' => [

            'direction' => 'ltr',
        ],
        'th' => [

            'direction' => 'ltr',
        ],
        'tr' => [

            'direction' => 'ltr',
        ],
        'bn' => [

            'direction' => 'ltr',
        ],
        'sq' => [

            'direction' => 'ltr',
        ],
        'hi' => [

            'direction' => 'ltr',
        ],
        'vi' => [

            'direction' => 'ltr',
        ],
        'aa' => [
            'direction' => 'ltr',
        ],
        'ab' => [
            'direction' => 'ltr',
        ],
        'ae' => [
            'direction' => 'ltr',
        ],
        'af' => [
            'direction' => 'ltr',
        ],
        'ak' => [
            'direction' => 'ltr',
        ],
        'am' => [
            'direction' => 'ltr',
        ],
        'an' => [
            'direction' => 'ltr',
        ],
        'as' => [
            'direction' => 'ltr',
        ],
        'av' => [
            'direction' => 'ltr',
        ],
        'ay' => [
            'direction' => 'ltr',
        ],
        'az' => [
            'direction' => 'ltr',
        ],
        'ba' => [
            'direction' => 'ltr',
        ],
        'be' => [
            'direction' => 'ltr',
        ],
        'bg' => [
            'direction' => 'ltr',
        ],
        'bh' => [
            'direction' => 'ltr',
        ],
        'bi' => [
            'direction' => 'ltr',
        ],
        'bm' => [
            'direction' => 'ltr',
        ],
        'bo' => [
            'direction' => 'ltr',
        ],
        'bs' => [
            'direction' => 'ltr',
        ],
        'ca' => [
            'direction' => 'ltr',
        ],
        'ce' => [
            'direction' => 'ltr',
        ],
        'ch' => [
            'direction' => 'ltr',
        ],
        'co' => [
            'direction' => 'ltr',
        ],
        'cr' => [
            'direction' => 'ltr',
        ],
        'cu' => [
            'direction' => 'ltr',
        ],
        'cv' => [
            'direction' => 'ltr',
        ],
        'cy' => [
            'direction' => 'ltr',
        ],
        'dv' => [
            'direction' => 'ltr',
        ],
        'dz' => [
            'direction' => 'ltr',
        ],
        'ee' => [
            'direction' => 'ltr',
        ],
        'eo' => [
            'direction' => 'ltr',
        ],
        'eu' => [
            'direction' => 'ltr',
        ],
        'ff' => [
            'direction' => 'ltr',
        ],
        'fj' => [
            'direction' => 'ltr',
        ],
        'fo' => [
            'direction' => 'ltr',
        ],
        'fy' => [
            'direction' => 'ltr',
        ],
        'ga' => [
            'direction' => 'ltr',
        ],
        'gd' => [
            'direction' => 'ltr',
        ],
        'gl' => [
            'direction' => 'ltr',
        ],
        'gn' => [
            'direction' => 'ltr',
        ],
        'gu' => [
            'direction' => 'ltr',
        ],
        'gv' => [
            'direction' => 'ltr',
        ],
        'ha' => [
            'direction' => 'ltr',
        ],
        'ho' => [
            'direction' => 'ltr',
        ],
        'hr' => [
            'direction' => 'ltr',
        ],
        'ht' => [
            'direction' => 'ltr',
        ],
        'hy' => [
            'direction' => 'ltr',
        ],
        'hz' => [
            'direction' => 'ltr',
        ],
        'ig' => [
            'direction' => 'ltr',
        ],
        'ii' => [
            'direction' => 'ltr',
        ],
        'ik' => [
            'direction' => 'ltr',
        ],
        'io' => [
            'direction' => 'ltr',
        ],
        'is' => [
            'direction' => 'ltr',
        ],
        'iu' => [
            'direction' => 'ltr',
        ],
        'ja' => [
            'direction' => 'ltr',
        ],
        'jv' => [
            'direction' => 'ltr',
        ],
        'ka' => [
            'direction' => 'ltr',
        ],
        'kg' => [
            'direction' => 'ltr',
        ],
        'ki' => [
            'direction' => 'ltr',
        ],
        'kj' => [
            'direction' => 'ltr',
        ],
        'kk' => [
            'direction' => 'ltr',
        ],
        'kl' => [
            'direction' => 'ltr',
        ],
        'km' => [
            'direction' => 'ltr',
        ],
        'kn' => [
            'direction' => 'ltr',
        ],
        'ko' => [
            'direction' => 'ltr',
        ],
        'kr' => [
            'direction' => 'ltr',
        ],
        'ks' => [
            'direction' => 'ltr',
        ],
        'ku' => [
            'direction' => 'rtl',
        ],
        'kv' => [
            'direction' => 'ltr',
        ],
        'kw' => [
            'direction' => 'ltr',
        ],
        'ky' => [
            'direction' => 'ltr',
        ],
        'la' => [
            'direction' => 'ltr',
        ],
        'lb' => [
            'direction' => 'ltr',
        ],
        'lg' => [
            'direction' => 'ltr',
        ],
        'li' => [
            'direction' => 'ltr',
        ],
        'ln' => [
            'direction' => 'ltr',
        ],
        'lo' => [
            'direction' => 'ltr',
        ],
        'lu' => [
            'direction' => 'ltr',
        ],
        'lv' => [
            'direction' => 'ltr',
        ],
        'mg' => [
            'direction' => 'ltr',
        ],
        'mh' => [
            'direction' => 'ltr',
        ],
        'mi' => [
            'direction' => 'ltr',
        ],
        'mk' => [
            'direction' => 'ltr',
        ],
        'ml' => [
            'direction' => 'ltr',
        ],
        'mn' => [
            'direction' => 'ltr',
        ],
        'mr' => [
            'direction' => 'ltr',
        ],
        'ms' => [
            'direction' => 'ltr',
        ],
        'mt' => [
            'direction' => 'ltr',
        ],
        'my' => [
            'direction' => 'ltr',
        ],
        'na' => [
            'direction' => 'ltr',
        ],
        'nb' => [
            'direction' => 'ltr',
        ],
        'nd' => [
            'direction' => 'ltr',
        ],
        'ne' => [
            'direction' => 'ltr',
        ],
        'ng' => [
            'direction' => 'ltr',
        ],
        'nn' => [
            'direction' => 'ltr',
        ],
        'no' => [
            'direction' => 'ltr',
        ],
        'nr' => [
            'direction' => 'ltr',
        ],
        'nv' => [
            'direction' => 'ltr',
        ],
        'ny' => [
            'direction' => 'ltr',
        ],
        'oc' => [
            'direction' => 'ltr',
        ],
        'oj' => [
            'direction' => 'ltr',
        ],
        'om' => [
            'direction' => 'ltr',
        ],
        'or' => [
            'direction' => 'ltr',
        ],
        'os' => [
            'direction' => 'ltr',
        ],
        'pa' => [
            'direction' => 'ltr',
        ],
        'pi' => [
            'direction' => 'ltr',
        ],
        'ps' => [
            'direction' => 'ltr',
        ],
        'qu' => [
            'direction' => 'ltr',
        ],
        'rm' => [
            'direction' => 'ltr',
        ],
        'rn' => [
            'direction' => 'ltr',
        ],
        'ro' => [
            'direction' => 'ltr',
        ],
        'rw' => [
            'direction' => 'ltr',
        ],
        'sa' => [
            'direction' => 'ltr',
        ],
        'sc' => [
            'direction' => 'ltr',
        ],
        'sd' => [
            'direction' => 'ltr',
        ],
        'se' => [
            'direction' => 'ltr',
        ],
        'sg' => [
            'direction' => 'ltr',
        ],
        'si' => [
            'direction' => 'ltr',
        ],
        'sk' => [
            'direction' => 'ltr',
        ],
        'sm' => [
            'direction' => 'ltr',
        ],
        'sn' => [
            'direction' => 'ltr',
        ],
        'so' => [
            'direction' => 'ltr',
        ],
        'sr' => [
            'direction' => 'ltr',
        ],
        'ss' => [
            'direction' => 'ltr',
        ],
        'st' => [
            'direction' => 'ltr',
        ],
        'su' => [
            'direction' => 'ltr',
        ],
        'sw' => [
            'direction' => 'ltr',
        ],
        'ta' => [
            'direction' => 'ltr',
        ],
        'te' => [
            'direction' => 'ltr',
        ],
        'tg' => [
            'direction' => 'ltr',
        ],
        'ti' => [
            'direction' => 'ltr',
        ],
        'tk' => [
            'direction' => 'ltr',
        ],
        'tl' => [
            'direction' => 'ltr',
        ],
        'tn' => [
            'direction' => 'ltr',
        ],
        'to' => [
            'direction' => 'ltr',
        ],
        'ts' => [
            'direction' => 'ltr',
        ],
        'tt' => [
            'direction' => 'ltr',
        ],
        'tw' => [
            'direction' => 'ltr',
        ],
        'ty' => [
            'direction' => 'ltr',
        ],
        'ug' => [
            'direction' => 'ltr',
        ],
        'uk' => [
            'direction' => 'ltr',
        ],
        'ur' => [
            'direction' => 'ltr',
        ],
        'uz' => [
            'direction' => 'ltr',
        ],
        've' => [
            'direction' => 'ltr',
        ],
        'vo' => [
            'direction' => 'ltr',
        ],
        'wa' => [
            'direction' => 'ltr',
        ],
        'wo' => [
            'direction' => 'ltr',
        ],
        'xh' => [
            'direction' => 'ltr',
        ],
        'yi' => [
            'direction' => 'ltr',
        ],
        'yo' => [
            'direction' => 'ltr',
        ],
        'za' => [
            'direction' => 'ltr',
        ],
        'zh' => [
            'direction' => 'ltr',
        ],
        'zu' => [
            'direction' => 'ltr',
        ],
    ]
];
