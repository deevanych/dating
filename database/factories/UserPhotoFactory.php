<?php

namespace Database\Factories;

use App\Models\UserPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'url' => 'https://placeimg.com/300/600/people?ver='.$this->faker->numberBetween(1, 50),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
