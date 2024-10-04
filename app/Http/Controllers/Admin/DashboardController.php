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
        $recettesCount = Recipe::count();
        $ingredientsCount = Ingredient::count();
        $usersCount = User::count();
        return view('admin.dashboard', compact('recettesCount', 'ingredientsCount', 'usersCount'));
    }
}
