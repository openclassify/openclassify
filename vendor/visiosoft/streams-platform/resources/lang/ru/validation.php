<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Аттрибут following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => "Аттрибут :attribute должен быть принят.",
    "active_url"           => "Аттрибут :attribute некорректный URL.",
    "after"                => "Аттрибут :attribute должен быть датой позже :date.",
    "alpha"                => "Аттрибут :attribute может содержать только буквы.",
    "alpha_dash"           => "Аттрибут :attribute может содержать только буквы, цифры, и дефисы.",
    "alpha_num"            => "Аттрибут :attribute может содержать только буквы и цифры.",
    "array"                => "Аттрибут :attribute должен быть массивом.",
    "before"               => "Аттрибут :attribute должен быть датой раньше :date.",
    "between"              => [
        "numeric" => "Аттрибут :attribute должен быть между :min и :max.",
        "file"    => "Аттрибут :attribute должен быть от :min до :max килобайт.",
        "string"  => "Аттрибут :attribute должен быть от :min до :max символов.",
        "array"   => "Аттрибут :attribute должени иметь от :min до :max элементов.",
    ],
    "boolean"              => "Аттрибут :attribute должен быть true или false",
    "confirmed"            => "Аттрибут :attribute подтверждение не совпадает.",
    "date"                 => "Аттрибут :attribute некорректная дата.",
    "date_format"          => "Аттрибут :attribute не совпадает с форматом :format.",
    "different"            => "Аттрибут :attribute и :other должны отличаться.",
    "digits"               => "Аттрибут :attribute должен быть длинной :digits цифр.",
    "digits_between"       => "Аттрибут :attribute должен быть длинной от :min до :max цифр.",
    "email"                => "Аттрибут :attribute должен быть корректным адресом email.",
    "filled"               => "Аттрибут :attribute обязателен.",
    "exists"               => "Выбранное значение :attribute неверно.",
    "image"                => "Аттрибут :attribute должен быть картинкой.",
    "in"                   => "Выбранное значение :attribute неверно.",
    "integer"              => "Аттрибут :attribute должен быть целым числом.",
    "ip"                   => "Аттрибут :attribute должен быть корректным IP-адресом.",
    "max"                  => [
        "numeric" => "Аттрибут :attribute не может быть больше :max.",
        "file"    => "Аттрибут :attribute не может быть больше :max килобайт.",
        "string"  => "Аттрибут :attribute не может быть больше :max символов.",
        "array"   => "Аттрибут :attribute не может иметь больше :max элементов.",
    ],
    "mimes"                => "Аттрибут :attribute должен быть файлом одного из типов: :values.",
    "min"                  => [
        "numeric" => "Аттрибут :attribute не должен быть меньше :min.",
        "file"    => "Аттрибут :attribute не должен быть меньше :min килобайт.",
        "string"  => "Аттрибут :attribute не должен быть меньше :min символов.",
        "array"   => "Аттрибут :attribute не должен иметь меньше :min элементов.",
    ],
    "not_in"               => "Выбранное значение :attribute не верно.",
    "numeric"              => "Аттрибут :attribute должен быть числом.",
    "regex"                => "Формат аттрибута :attribute не правильный.",
    "required"             => "Аттрибут :attribute обязателен.",
    "required_if"          => "Аттрибут :attribute обязателен, когда :other равно :value.",
    "required_with"        => "Аттрибут :attribute обязателен, когда заданы :values.",
    "required_with_all"    => "Аттрибут :attribute обязателен, когда каждое из :values задано.",
    "required_without"     => "Аттрибут :attribute обязателен, когда :values не заданы.",
    "required_without_all" => "Аттрибут :attribute обязателен, когда ни одно из :values не задано.",
    "same"                 => "Аттрибуты :attribute и :other должны совпадать.",
    "size"                 => [
        "numeric" => "Аттрибут :attribute должен быть размером :size.",
        "file"    => "Аттрибут :attribute должен быть размером :size килобайт.",
        "string"  => "Аттрибут :attribute должен быть размером :size символов.",
        "array"   => "Аттрибут :attribute должен содержать :size элементов.",
    ],
    "invalid"              => "Аттрибут :attribute не верен.",
    "unique"               => "Аттрибут :attribute уже используется.",
    "unique_trash"         => "Аттрибут :attribute уже используется удаленной в корзину записью.",
    "url"                  => "Аттрибут :attribute имеет неправильный формат.",
    "timezone"             => "Аттрибут :attribute должен быть корректной временной зоной.",
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
    | Аттрибут following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
