<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description'=> $this->faker->sentence(10),
            'recipe_id'=> Recipe::factory(),
            'created_at'=> $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at'=> $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
