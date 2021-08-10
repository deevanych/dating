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
            'url' => $this->faker->imageUrl('400', '600'),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
