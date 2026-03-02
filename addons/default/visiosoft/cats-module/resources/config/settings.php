<?php

return [
    'sitemap_dividing_number' => [
        "type"   => "anomaly.field_type.integer",
        "config" => [
            "default_value" => 5000
        ]
    ],
    "include_cities_sitemap" => [
        "type"   => "anomaly.field_type.boolean",
        "config" => [
            "default_value" => false,
            "mode"          => "checkbox"
        ]
    ]
];
