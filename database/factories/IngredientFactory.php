<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=> $this->faker->word(),
            'description'=> $this->faker->sentence(15),
            'created_at'=> $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at'=> $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
