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

    "accepted"             => ":attribute 必须接受.",
    "active_url"           => ":attribute 无效的URL.",
    "after"                => ":attribute 必须是在 :date 之后的日期.",
    "alpha"                => ":attribute 仅允许字母.",
    "alpha_dash"           => ":attribute 仅允许字母、数字以及中划线.",
    "alpha_num"            => ":attribute 仅允许字母与数字.",
    "array"                => ":attribute 必须为数组.",
    "before"               => ":attribute 必须是在 :date 之前的日期.",
    "between"              => [
        "numeric" => ":attribute 必须介于 :min 和 :max 之间.",
        "file"    => ":attribute 必须介于 :min 和 :max kilobytes 之间.",
        "string"  => ":attribute 必须介于 :min 和 :max 字符之间.",
        "array"   => ":attribute 必须介于 :min 和 :max 项目之间.",
    ],
    "boolean"              => ":attribute 字段必须是 true 或 false.",
    "confirmed"            => ":attribute 两次输入不匹配.",
    "date"                 => ":attribute 不是有效的日期.",
    "date_format"          => ":attribute 的格式必须为 :format.",
    "different"            => ":attribute 和 :other 不能相同.",
    "digits"               => ":attribute 必须为 :digits 位数字.",
    "digits_between"       => ":attribute 必须介于 :min 和 :max 位数之间.",
    "email"                => ":attribute 必须为有效的电子邮件.",
    "filled"               => ":attribute 字段为必填.",
    "exists"               => "所选的 :attribute 无效.",
    "image"                => ":attribute 必须为图片.",
    "in"                   => "所选的 :attribute 无效.",
    "integer"              => ":attribute 必须为整数.",
    "ip"                   => ":attribute 必须为有效的 IP 地址。",
    "max"                  => [
        "numeric" => ":attribute 不能大于 :max.",
        "file"    => ":attribute 不能大于 :max Kb.",
        "string"  => ":attribute 不能大于 :max 字符.",
        "array"   => ":attribute 不能多于 :max 个项目.",
    ],
    "mimes"                => ":attribute 必须是 :values 格式的文件。",
    "min"                  => [
        "numeric" => ":attribute 必须是大于或等于 :min.",
        "file"    => ":attribute 必须是大于或等于 :min Kb.",
        "string"  => ":attribute 必须是大于或等于 :min 字符.",
        "array"   => ":attribute 必须是大于或等于 :min 个项目.",
    ],
    "not_in"               => "所选择的 :attribute 无效.",
    "numeric"              => ":attribute 必须为数字.",
    "regex"                => ":attribute 格式不正确.",
    "required"             => ":attribute 字段为必填.",
    "required_if"          => "当 :other 为 :value 时 :attribute 字段为必填..",
    "required_with"        => "若 :values 存在 :attribute 字段为必填.",
    "required_with_all"    => "若 :values 均存在 :attribute 字段为必填.",
    "required_without"     => "若 :values 不存在 :attribute 字段为必填.",
    "required_without_all" => "若 :values 均不存在 :attribute 字段为必填.",
    "same"                 => ":attribute 与 :other 必须匹配.",
    "size"                 => [
        "numeric" => ":attribute 必须是 :size .",
        "file"    => ":attribute 必须是 :size kilobytes.",
        "string"  => ":attribute 必须是 :size 字符.",
        "array"   => ":attribute 必须包含 :size 个条目.",
    ],
    "invalid"              => ":attribute 无效.",
    "unique"               => ":attribute 已经被使用。",
    "unique_trash"         => ":attribute 被已被回收站中的条目使用.",
    "url"                  => ":attribute 格式不正确。",
    "timezone"             => ":attribute 必须是正确的时区。",
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
