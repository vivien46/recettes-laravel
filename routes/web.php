<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

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

/*
 TODO: Implémenter la gestion des ingrédients

TODO: Routes pour les ingrédients

TODO: Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');

TODO: Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');

TODO: Ajouter d'autres routes pour la gestion des ingrédients (modification, suppression, etc.)
*/
