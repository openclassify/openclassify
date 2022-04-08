<?php

$factory->define(
    \Anomaly\UsersModule\Role\RoleModel::class,
    function (Faker\Generator $faker) {
        return [
            'slug' => $faker->slug,
            'name' => $faker->word,
            'description' => $faker->words(3, true),
            'permissions' => ["anomaly.module.users::users.read"]
        ];
    }
);
