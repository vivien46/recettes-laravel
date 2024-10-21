<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');

// Routes pour la vérification des emails
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->name('verification.send');
    
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
});

// Recettes protégées par auth et vérification d'e-mail
Route::middleware(['auth'])->group(function () {
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
    Route::get('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');
    Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');
    
    Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
    Route::put('/recettes/{id}', [RecetteController::class, 'update'])->name('recettes.update');
    Route::delete('/recettes/{id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');
    
    // Routes pour les ingrédients
    Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
    // Route pour la recherche d'ingrédients (API AJAX)
    Route::get('/ingredients/search', [IngredientController::class, 'search'])->name('ingredients.search');
    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::get('/ingredients/{id}', [IngredientController::class, 'show'])->name('ingredients.show');
    Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
    
    Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
    
});

// Routes pour les utilisateurs (protégées par vérification d'e-mail également)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

// TODO Route pour la recherche de recettes (API AJAX) 

Route::middleware([EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
}); 