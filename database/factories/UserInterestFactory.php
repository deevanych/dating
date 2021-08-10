<?php

namespace Database\Factories;

use App\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInterestFactory extends Factory
{
    public function definition(): array
    {
    	return [
    	    //
            'title' => $this->faker->word,
            'user_interest_type_id' => $this->faker->numberBetween(1, 5),
    	];
    }
}
