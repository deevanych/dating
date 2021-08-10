<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'birthday_date' => $this->faker->date,
            'city' => $this->faker->city,
            'sex' => $this->faker->boolean,
            'about' => $this->faker->paragraph(2),
            'status' => $this->faker->realText(20),
            'email' => $this->faker->safeEmail,
            'is_verified' => $this->faker->boolean,
        ];
    }
}
