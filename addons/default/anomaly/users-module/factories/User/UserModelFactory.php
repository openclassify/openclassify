<?php

namespace Database\Factories\Anomaly\UsersModule\User;

use Anomaly\UsersModule\User\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'display_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('secret'),
            'activated' => 1,
            'enabled' => 1,
            'permissions' => ["anomaly.module.users::users.read"]
        ];
    }
}
