<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnreportedIncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area' => $this->faker->address(),
            'gender' => $this->faker->randomElements(['male', 'female'])[0],
            'police_station' => $this->faker->randomElements(['Ain Shams', 'Nozha', 'Matarya', 'Marg', 'New Cairo'])[0],
            'picture' => 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80',
            'user_id' => User::factory()
        ];
    }
}
