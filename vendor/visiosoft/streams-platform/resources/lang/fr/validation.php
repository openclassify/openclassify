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

    "accepted"             => ":attribute doit être accepté.",
    "active_url"           => ":attribute n'est pas une URL valide.",
    "after"                => ":attribute doit être une date supérieure à la date :date.",
    "alpha"                => ":attribute peut uniquement contenir des lettres.",
    "alpha_dash"           => ":attribute peut uniquement contenir des lettres, des chiffres et des tirets.",
    "alpha_num"            => ":attribute peut uniquement contenir des chiffres et des lettres.",
    "array"                => ":attribute doit être un tableau.",
    "before"               => ":attribute doit être une date inférieur à la date :date.",
    "between"              => [
        "numeric" => ":attribute doit être entre :min et :max.",
        "file"    => ":attribute doit faire entre :min et :max Ko.",
        "string"  => ":attribute doit faire entre :min et :max caractères.",
        "array"   => ":attribute doit avoir entre :min et :max éléments.",
    ],
    "boolean"              => ":attribute doit être un booléen.",
    "confirmed"            => ":attribute doit être confirmé.",
    "date"                 => ":attribute doit être une date valide.",
    "date_format"          => ":attribute ne respecte pas le format :format.",
    "different"            => ":attribute et :other doivent être différents.",
    "digits"               => ":attribute doit faire :digits chiffres.",
    "digits_between"       => ":attribute doit faire entre :min et :max chiffres.",
    "email"                => ":attribute doit être une adresse email valide.",
    "filled"               => ":attribute est requis.",
    "exists"               => ":attribute sélectionné est invalide.",
    "image"                => ":attribute doit être une image.",
    "in"                   => ":attribute sélectionné est invalide.",
    "integer"              => ":attribute doit être un nombre.",
    "ip"                   => ":attribute doit être une adresse IP valide.",
    "max"                  => [
        "numeric" => ":attribute ne doit être plus grand que :max.",
        "file"    => ":attribute ne doit faire plus de :max Ko.",
        "string"  => ":attribute ne doit pas faire plus de :max caractères.",
        "array"   => ":attribute ne doit pas avoir plus de :max éléments.",
    ],
    "mimes"                => ":attribute doit être un fichier de type : :values.",
    "min"                  => [
        "numeric" => ":attribute doit être au moins à :min.",
        "file"    => ":attribute doit faire au moins :min Ko.",
        "string"  => ":attribute doit faire au moins :min caractères.",
        "array"   => ":attribute doit avoir au moins :min éléments.",
    ],
    "not_in"               => ":attribute contient un élément invalide.",
    "numeric"              => ":attribute doit être un nombre.",
    "regex"                => ":attribute est au mauvais format.",
    "required"             => ":attribute est requis.",
    "required_if"          => ":attribute est requis quand :other à pour valeur :value.",
    "required_with"        => ":attribute est requis quand :values est présent.",
    "required_with_all"    => ":attribute est requis quand :values est présent.",
    "required_without"     => ":attribute est requis quand :values n'est pas présent.",
    "required_without_all" => ":attribute est requis quand aucune des valeurs :values est présente.",
    "same"                 => ":attribute et :other doivent être identiques.",
    "size"                 => [
        "numeric" => ":attribute doit faire :size.",
        "file"    => ":attribute doit faire :size Ko.",
        "string"  => ":attribute doit faire :size caractères.",
        "array"   => ":attribute doit contenir :size éléments.",
    ],
    "unique"               => ":attribute a déjà été pris.",
    "url"                  => ":attribute a un format invalide.",
    "timezone"             => ":attribute doit être un fuseau horaire valide.",
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
