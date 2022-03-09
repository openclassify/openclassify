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

    "accepted"             => "O :attribute deve ser aceito.",
    "active_url"           => ":attribute não é uma URL válida.",
    "after"                => "A :attribute deve ser posterior a :date.",
    "alpha"                => "O :attribute deve conter somente letras.",
    "alpha_dash"           => "O :attribute deve conter apenas letras, números e traços.",
    "alpha_num"            => "O :attribute deve conter apenas letras e números.",
    "array"                => "O :attribute deve ser um array.",
    "before"               => "o :attribute deve ser anterior a :date.",
    "between"              => [
        "numeric" => "O :attribute deve ser menor que :min e maior que :max.",
        "file"    => "O :attribute deve estar entre :min e :max kilobytes.",
        "string"  => "O :attribute deve estar entre :min e :max caracteres.",
        "array"   => "O :attribute deve estar entre :min e :max itens.",
    ],
    "boolean"              => "O :attribute campo deve ser verdadeiro ou falso",
    "confirmed"            => "O :attribute confirmação não coincide.",
    "date"                 => "O :attribute não é uma data válida.",
    "date_format"          => "O :attribute não está de acordo co o padrão :format.",
    "different"            => "O :attribute e :other devem ser diferentes.",
    "digits"               => "O :attribute deve ser :digits digitos.",
    "digits_between"       => "O :attribute deve estar entre :min e :max digitos.",
    "email"                => "O :attribute deve ser um e-mail válido.",
    "filled"               => "O :attribute campo é obrigatório.",
    "exists"               => "O :attribute selecionado é inválido.",
    "image"                => "O :attribute deve ser uma imagem.",
    "in"                   => "O :attribute selecionado é inválido.",
    "integer"              => "O :attribute deve ser inteiro.",
    "ip"                   => "O :attribute deve ser um endereço IP válido.",
    "max"                  => [
        "numeric" => "O :attribute não pode ser maior que :max.",
        "file"    => "O :attribute não deve exceder :max kilobytes.",
        "string"  => "O :attribute não deve exceder :max caracteres.",
        "array"   => "O :attribute não deve conter mais do que :max itens.",
    ],
    "mimes"                => "O :attribute deve ser um arquivo do tipo: :values.",
    "min"                  => [
        "numeric" => "O :attribute deve ser pelo menos :min.",
        "file"    => "O :attribute deve ter no mínimo :min kilobytes.",
        "string"  => "O :attribute deve conter no mínimo :min caaracteres.",
        "array"   => "O :attribute deve ter pelo menos :min itens.",
    ],
    "not_in"               => "O :attribute selecionado é inválido",
    "numeric"              => "O :attribute deve ser um número.",
    "regex"                => "O formato :attribute é inválido .",
    "required"             => "O campo :attribute é obrigatório.",
    "required_if"          => "O campo :attribute é obrigatório quando :other é :value.",
    "required_with"        => "O campo :attribute é obrigatório quando :values é present.",
    "required_with_all"    => "O campo :attribute é obrigatório quando :values é present.",
    "required_without"     => "O campo :attribute é obrigatório quando :values é not present.",
    "required_without_all" => "O campo :attribute é obrigatório quando nenhum dos :values estão presentes.",
    "same"                 => "O :attribute e :other devem coincidir.",
    "size"                 => [
        "numeric" => "O :attribute deve ser :size.",
        "file"    => "O :attribute deve ter :size kilobytes.",
        "string"  => "O :attribute deve ter :size caracteres.",
        "array"   => "O :attribute deve conter :size itens.",
    ],
    "invalid"              => "O :attribute é inválido.",
    "unique"               => "O :attribute já foi usado.",
    "unique_trash"         => "O :attribute já foi usaado por um item na lixeira.",
    "url"                  => "O formato :attribute é inválido.",
    "timezone"             => "O :attribute deve ser um fuso-horário válido.",
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
