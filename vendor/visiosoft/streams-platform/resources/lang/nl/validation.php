<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => "De :attribute moet worden geaccepteerd.",
    "active_url"           => "De :attribute is geen valide URL.",
    "after"                => "De :attribute moet een datum zijn na :date.",
    "alpha"                => "De :attribute mag alleen letters bevatten.",
    "alpha_dash"           => "De :attribute mag alleen letters, nummers en streepjes bevatten.",
    "alpha_num"            => "De :attribute mag alleen letters en nummers bevatten.",
    "array"                => "De :attribute moet een array zijn.",
    "before"               => "De :attribute moet een datum zijn voor :date.",
    "between"              => [
        "numeric" => "De :attribute moet tussen :min en :max zijn.",
        "file"    => "De :attribute moet tussen :min en :max kilobytes zijn.",
        "string"  => "De :attribute moet tussen :min en :max karakters hebben.",
        "array"   => "De :attribute moet tussen :min en :max items bevatten.",
    ],
    "boolean"              => "Het :attribute veld moet true of false zijn.",
    "confirmed"            => "De :attribute bevestiging komt niet overeen.",
    "date"                 => "De :attribute is geen geldige datum.",
    "date_format"          => "De :attribute komt niet overeen met het format :format.",
    "different"            => "De :attribute en :other moeten verschillend zijn.",
    "digits"               => "De :attribute moeten :digits cijfers zijn.",
    "digits_between"       => "De :attribute moeten tussen :min en :max cijfers zijn.",
    "email"                => "De :attribute moet een geldig emailadres zijn.",
    "filled"               => "Het :attribute veld is verplicht.",
    "exists"               => "De geselecteerde :attribute is ongeldig.",
    "image"                => "De :attribute moet een afbeelding zijn.",
    "in"                   => "De geselecteerde :attribute is ongeldig.",
    "integer"              => "De :attribute moet een integer zijn.",
    "ip"                   => "De :attribute moet een geldig IP adres zijn.",
    "max"                  => [
        "numeric" => "De :attribute mag niet groter zijn dan :max.",
        "file"    => "De :attribute mag niet groter zijn dan :max kilobytes.",
        "string"  => "De :attribute mag niet groter zijn dan :max karakters.",
        "array"   => "De :attribute mag niet meer dan :max items hebben.",
    ],
    "mimes"                => "De :attribute moet zijn van het volgende type: :values.",
    "min"                  => [
        "numeric" => "De :attribute moet minimaal :min zijn.",
        "file"    => "De :attribute moet minimaal :min kilobytes zijn.",
        "string"  => "De :attribute moet minimaal :min karakters hebben.",
        "array"   => "De :attribute moet minimaal :min items. bevatten",
    ],
    "not_in"               => "De geselecteerde :attribute is ongeldig.",
    "numeric"              => "De :attribute moet een nummer zijn.",
    "regex"                => "Het :attribute format is ongeldig.",
    "required"             => "Het :attribute veld is verplicht.",
    "required_if"          => "Het :attribute veld is verplicht als :other is :value.",
    "required_with"        => "Het :attribute veld is verplicht als :values aanwezig is.",
    "required_with_all"    => "Het :attribute veld is verplicht als :values aanwezig is.",
    "required_without"     => "Het :attribute veld is verplicht als :values niet aanwezig is.",
    "required_without_all" => "Het :attribute veld is verplicht als geen enkele :values aanwezig is.",
    "same"                 => "De :attribute en :other moeten overeenkomen.",
    "size"                 => [
        "numeric" => "De :attribute moet :size zijn.",
        "file"    => "De :attribute moet :size kilobytes zijn.",
        "string"  => "De :attribute moet :size karakters hebben.",
        "array"   => "De :attribute moet :size items bevatten.",
    ],
    "invalid"              => "De :attribute is ongeldig.",
    "unique"               => "De :attribute is al bezet.",
    "unique_trash"         => "De :attribute is hoogstwaarschijnlijk al bezet bij een prullenbak ingave.",
    "url"                  => "Het :attribute format is ongeldig.",
    "timezone"             => "De :attribute moet een geldige zone zijn.",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
