<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word . $this->faker->randomElement(['.pdf', '.doc', '.zip']),
            'langue' => $this->faker->randomElement(['en', 'fr']), 
            'user_id' => User::all()->random()->id
        ];
    }
}
