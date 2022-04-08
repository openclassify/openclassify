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

    "accepted"             => "這個 :attribute 必須接受。",
    "active_url"           => "這個 :attribute 不是正確的網址。",
    "after"                => "這個 :attribute 必須是個日期，並且是在 :date 之後。",
    "alpha"                => "這個 :attribute 只能包含文字。",
    "alpha_dash"           => "這個 :attribute 只能包含文字、數字以及划線(dash)。",
    "alpha_num"            => "這個 :attribute 只能包含文字與數字。",
    "array"                => "這個 :attribute 必須是陣列(array)。",
    "before"               => "這個 :attribute 必須是個日期，並且是在 :date 之前。",
    "between"              => [
        "numeric" => "這個 :attribute 必須介於 :min 和 :max 之間。",
        "file"    => "這個 :attribute 必須介於 :min 和 :max kilobytes 之間。",
        "string"  => "這個 :attribute 必須介於 :min 和 :max 字元之間。",
        "array"   => "這個 :attribute 必須介於 :min 和 :max 項目之間。",
    ],
    "boolean"              => "這個 :attribute 欄位必須是 true 或 false。",
    "confirmed"            => "這個 :attribute 確認並不能匹配。",
    "date"                 => "這個 :attribute 不是正確的日期。",
    "date_format"          => "這個 :attribute 格式並不能與 :format 匹配。",
    "different"            => "這個 :attribute 和 :other 必須是不同的。",
    "digits"               => "這個 :attribute 必須是 :digits 位數。",
    "digits_between"       => "這個 :attribute 必須介於 :min 和 :max 位數之間。",
    "email"                => "這個 :attribute 必須是一個正確的電子郵件。",
    "filled"               => "這個 :attribute 欄位是必填的。",
    "exists"               => "所選擇的 :attribute 並不正確。",
    "image"                => "這個 :attribute 必須是一個影像。",
    "in"                   => "所選擇的 :attribute 並不正確。",
    "integer"              => "這個 :attribute 必須是一個整數。",
    "ip"                   => "這個 :attribute 必須是一個正確的 IP 位址。",
    "max"                  => [
        "numeric" => "這個 :attribute 不能大於 :max。",
        "file"    => "這個 :attribute 不能大於 :max kilobytes。",
        "string"  => "這個 :attribute 不能大於 :max 字元。",
        "array"   => "這個 :attribute 不能多於 :max 個項目。",
    ],
    "mimes"                => "這個 :attribute 必須是 :values 格式的檔案。",
    "min"                  => [
        "numeric" => "這個 :attribute 必須是大於或等於 :min。",
        "file"    => "這個 :attribute 必須是大於或等於 :min kilobytes。",
        "string"  => "這個 :attribute 必須是大於或等於 :min 字元。",
        "array"   => "這個 :attribute 必須是大於或等於 :min 個項目。",
    ],
    "not_in"               => "所選擇的 :attribute 不正確。",
    "numeric"              => "這個 :attribute 必須是一個數字。",
    "regex"                => "這個 :attribute 格式不正確。",
    "required"             => "這個 :attribute 欄位是必填的。",
    "required_if"          => "這個 :attribute 欄位是必填的，在 :other 是 :value 的條件下。",
    "required_with"        => "這個 :attribute 欄位是必填的，當 :values 存在的條件下。",
    "required_with_all"    => "這個 :attribute 欄位是必填的，當 :values 存在的條件下。",
    "required_without"     => "這個 :attribute 欄位是必填的，當 :values 不存在的條件下。",
    "required_without_all" => "這個 :attribute 欄位是必填的，當 :values 都不存在的條件下。",
    "same"                 => "這個 :attribute 和 :other 必須匹配。",
    "size"                 => [
        "numeric" => "這個 :attribute 必須是 :size。",
        "file"    => "這個 :attribute 必須是 :size kilobytes。",
        "string"  => "這個 :attribute 必須是 :size 字元。",
        "array"   => "這個 :attribute 必須包含 :size 個項目",
    ],
    "unique"               => "這個 :attribute 已經被使用。",
    "url"                  => "這個 :attribute 格式不正確。",
    "timezone"             => "這個 :attribute 必須是正確的時區。",
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
