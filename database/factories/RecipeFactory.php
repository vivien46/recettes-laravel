<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $temps_preparation = $this->faker->numberBetween(5, 120);
        $temps_cuisson = $this->faker->numberBetween(5, 120);
        $temps_repos = $this->faker->numberBetween(5, 120);
        $temps_total = $temps_preparation + $temps_cuisson + $temps_repos;

        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'temps_preparation' => $temps_preparation,
            'temps_cuisson' => $temps_cuisson,
            'temps_repos' => $temps_repos,
            'temps_total' => $temps_total,
            'portion' => $this->faker->numberBetween(1, 10),
            'difficulte' => $this->faker->randomElement(['facile', 'moyenne', 'difficile']),
            'type' => $this->faker->randomElement(['entree', 'plat', 'dessert', 'boisson', 'autre']),
            'imageUrl' => $this->faker->imageUrl(),
            'user_id' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {
            $ingredients = Ingredient::factory()->count(5)->create();

            foreach ($ingredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient->id, [
                    'quantite' => $this->faker->numberBetween(1, 100) . ' ' . $this->faker->randomElement(['g', 'kg', 'ml', 'cl', 'l', 'cuillère à café', 'cuillère à soupe', 'unité']),
                ]);
            }
        });
    }
}
