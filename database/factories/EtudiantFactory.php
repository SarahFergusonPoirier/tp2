<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;
use App\Models\User;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nomEtudiant' => function(array $attributes) {
                return User::find($attributes['user_id'])->name;
            }, 
            'adresse' => $this->faker->streetAddress, 
            'phone' => $this->faker->phoneNumber,
            'email' => function(array $attributes) {
                return User::find($attributes['user_id'])->email;
            }, 
            'naissance' => $this->faker->date, 
            'ville_id' => Ville::all()->random()->id,
        ];
    }
}
