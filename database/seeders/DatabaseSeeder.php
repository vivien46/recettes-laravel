<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Step;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Créer exactement 10 utilisateurs
    $users = User::factory(10)->create();

    // Pour chaque utilisateur, créer entre 1 et 3 recettes
    foreach ($users as $user) {
        $recipes = Recipe::factory(rand(1, 3))
            ->create(['user_id' => $user->id]);

        // Utiliser foreach pour chaque recette
        foreach ($recipes as $recipe) {
            $stepCount = rand(1, 5); // Nombre aléatoire d'étapes

            // Boucle for pour générer les étapes avec un 'order' séquentiel
            for ($i = 1; $i <= $stepCount; $i++) {
                Step::create([
                    'order' => $i, // Numérotation séquentielle
                    'description' => fake()->sentence(), // Générer une description aléatoire
                    'recipe_id' => $recipe->id, // Associer à la recette
                ]);
            }
        }
    }
}

  
}