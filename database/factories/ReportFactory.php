<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'national_id' => $this->faker->unique()->randomNumber(),
            'age' => $this->faker->numberBetween(3,14),
            'area' => $this->faker->address(),
            'gender' => $this->faker->randomElements(['male', 'female'])[0],
            'picture' => 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80',
            'clothes_last_seen_wearing' => $this->faker->randomElements(['blue jeans', 'yellow shirt', 'black shorts', 'green jacket'])[0],
            'birthmark' => $this->faker->randomElements(['spot on neck', 'spot on left leg', null])[0],
            'user_id' => User::factory()
        ];
    }
}
