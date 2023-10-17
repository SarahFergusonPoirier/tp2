<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ForumPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence, 
            'corps' => $this->faker->paragraph(30),
            'langue' => $this->faker->randomElement(['en', 'fr']), 
            'user_id' => User::all()->random()->id
        ];
    }
}
