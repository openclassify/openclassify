<?php

$factory->define(
    Anomaly\UsersModule\User\UserModel::class,
    function (Faker\Generator $faker) {
        return [
            'username' => $faker->userName,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'display_name' => $faker->name,
            'email' => $faker->safeEmail,
            'password' => bcrypt('secret'),
            'activated' => 1,
            'enabled' => 1,
            'permissions' => ["anomaly.module.users::users.read"]
        ];
    }
);
