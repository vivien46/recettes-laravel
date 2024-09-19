<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
Route::get ('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
Route::get('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');
Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');

Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
Route::put('/recettes/{id}', [RecetteController::class, 'update'])->name('recettes.update');
Route::delete('/recettes/{id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');

// Routes pour les ingrédients
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
Route::get('/ingredients/{id}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');

Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');