<?php

namespace Database\Factories\Anomaly\UsersModule\Role;

use Anomaly\UsersModule\Role\RoleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'name' => $this->faker->word,
            'description' => $this->faker->words(3, true),
            'permissions' => ["anomaly.module.users::users.read"]
        ];
    }
}
