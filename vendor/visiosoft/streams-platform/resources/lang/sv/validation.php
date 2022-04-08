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

    "accepted"             => ":attribute måste godkännas.",
    "active_url"           => ":attribute är inte en giltig URL.",
    "after"                => ":attribute måste vara ett datum efter :date.",
    "alpha"                => ":attribute får endast innehålla bokstäver.",
    "alpha_dash"           => ":attribute får endast innehålla bokstäver, nummer och bindestreck.",
    "alpha_num"            => ":attribute får endast innehålla bokstäver och nummer.",
    "array"                => ":attribute måste vara ett fält (array).",
    "before"               => ":attribute måste vara ett datum innan :date.",
    "between"              => [
        "numeric" => ":attribute måste vara mellan :min och :max.",
        "file"    => ":attribute måste vara mellan :min och :max kilobyte.",
        "string"  => ":attribute måste vara mellan :min och :max karaktärer.",
        "array"   => ":attribute måste ha minst :min och max :max föremål.",
    ],
    "boolean"              => ":attribute fältet måste vara sant eller falskt.",
    "confirmed"            => ":attribute bekräftelsen matchar inte.",
    "date"                 => ":attribute är inte ett giltigt datum.",
    "date_format"          => ":attribute matchar inte formatet :format.",
    "different"            => ":attribute och :other vara olika.",
    "digits"               => ":attribute får endast innehålla följande siffror: :digits.",
    "digits_between"       => ":attribute måste vara mellan siffrorna :min och :max.",
    "email"                => ":attribute måste vara en giltig e-postadress.",
    "filled"               => ":attribute fältet är obligatoriskt.",
    "exists"               => ":attribute fältet är ogiltigt.",
    "image"                => ":attribute måste vara en bild.",
    "in"                   => ":attribute fältet är ogiltigt.",
    "integer"              => ":attribute måste vara ett heltal.",
    "ip"                   => ":attribute måste vara en giltig IP-adress.",
    "max"                  => [
        "numeric" => ":attribute får inte vara större än :max.",
        "file"    => ":attribute får inte vara större än :max kilobyte.",
        "string"  => ":attribute får inte vara längre än :max karaktärer.",
        "array"   => ":attribute får inte ha fler än :max föremål.",
    ],
    "mimes"                => ":attribute måste vara en fil av typen :values.",
    "min"                  => [
        "numeric" => ":attribute måste vara större än :min.",
        "file"    => ":attribute måste vara större än :min kilobyte.",
        "string"  => ":attribute måste innehålla minst :min karatärer.",
        "array"   => ":attribute måste innehålla minst :min föremål.",
    ],
    "not_in"               => "Det valda :attribute fältet är ogiltigt.",
    "numeric"              => ":attribute måste vara ett nummer.",
    "regex"                => ":attribute är ogiltigt.",
    "required"             => ":attribute fältet är obligatoriskt.",
    "required_if"          => ":attribute fältet är obligatoriskt när :other är :value.",
    "required_with"        => ":attribute fältet är obligatoriskt när :values finns.",
    "required_with_all"    => ":attribute fältet är obligatoriskt när :values finns.",
    "required_without"     => ":attribute fältet är obligatoriskt när :values inte finns.",
    "required_without_all" => ":attribute fältet är obligatoriskt när ingen av :values finns.",
    "same"                 => ":attribute och :other måste matcha varandra.",
    "size"                 => [
        "numeric" => ":attribute vara exakt :size.",
        "file"    => ":attribute vara exakt :size kilobyte.",
        "string"  => ":attribute innehålla exakt :size karaktärer.",
        "array"   => ":attribute innehålla exakt :size föremål.",
    ],
    "invalid"              => ":attribute är felaktigt.",
    "unique"               => ":attribute har redan tagits av någon annan.",
    "unique_trash"         => ":attribute har redan tagits av ett slängt inlägg.",
    "url"                  => ":attribute formatet är ogiltigt.",
    "timezone"             => ":attribute måste vara en giltig tidszon.",
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
