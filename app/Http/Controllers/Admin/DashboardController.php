<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $recentUsers = User::orderBy('created_at',  'desc')->limit(5)->get();
        $recentRecipes = Recipe::orderBy('created_at',  'desc')->limit(5)->get();

        $recipesCount = Recipe::count();
        $ingredientsCount = Ingredient::count();
        $usersCount = User::count();

        Carbon::setLocale('fr');

        // Préparer les données pour le graphique des recettes par mois
        $months = collect();
        $recipeData = collect();

        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths($i);
            $months->prepend($date->translatedFormat('F')); // Ajoute le nom du mois dans l'ordre correct
            $recipeData->prepend(
                Recipe::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            );
        }

        // Afficher la part de recettes par type de recette
        $recipeTypes = ['entree', 'plat', 'dessert', 'boisson', 'autre'];
        $recipeTypeData = [];

        foreach ($recipeTypes as $type) {
            $recipeTypeData[$type] = Recipe::where('type', $type)->count();
        }

        return view('admin.dashboard', compact(
            'recipesCount',
            'ingredientsCount',
            'usersCount',
            'recentUsers',
            'recentRecipes',
            'months',
            'recipeData',
            'recipeTypeData',
        ));
    }
}
