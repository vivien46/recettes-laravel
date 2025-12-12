<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

use App\Http\Middleware\EnsureAdmin;

use App\Http\Controllers\RecetteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

require __DIR__ . '/auth.php';

// Health check Cloud Run
Route::get('/health', function () {
    Log::info('✅ Cloud Run fonctionne');
    return response()->json(['status' => 'ok']);
})->name('health');

// Accueil
Route::view('/', 'welcome')->name('home');

// Recettes (public)
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
Route::get('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');

// Routes protégées (auth + verified)
Route::middleware(['auth', 'verified'])->group(function () {

    // Recettes
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
    Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');

    Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
    Route::put('/recettes/{id}', [RecetteController::class, 'update'])->name('recettes.update');
    Route::delete('/recettes/{id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');

    // Ingrédients
    Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/search', [IngredientController::class, 'search'])->name('ingredients.search');

    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::get('/ingredients/{id}', [IngredientController::class, 'show'])->name('ingredients.show');
    Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');

    Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');

    // Profil utilisateur
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/profile/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Admin
Route::middleware([EnsureAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');

        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
