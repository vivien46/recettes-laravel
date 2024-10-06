<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $recentUsers = User::orderBy('created_at',  'desc')->limit(5)->get();
        $recentRecipes = Recipe::orderBy('created_at',  'desc')->limit(5)->get();

        $recipesCount = Recipe::count();
        $ingredientsCount = Ingredient::count();
        $usersCount = User::count();
        return view('admin.dashboard', compact('recipesCount', 'ingredientsCount', 'usersCount', 'recentUsers', 'recentRecipes'));
    }
}
