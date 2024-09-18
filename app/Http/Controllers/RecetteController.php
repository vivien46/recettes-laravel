<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecetteController extends Controller
{
    // Afficher la liste des recettes
    public function index()
    {
        $recipes = Recipe::all();
        return view('recettes.index', compact('recipes'));
    }

    // Afficher une seule recette
    public function show($id)
    {
        $recipe = Recipe::with('ingredients')->findOrFail($id);
        return view('recettes.show', compact('recipe'));
    }

    // Afficher le formulaire de création d'une recette
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recettes.create', compact('ingredients'));
    }

    // Enregistrer une recette avec les ingrédients
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'temps_preparation' => 'nullable|integer',
            'temps_cuisson' => 'nullable|integer',
            'temps_repos' => 'nullable|integer',
            'temps_total' => 'nullable|integer',
            'portion' => 'nullable|integer',
            'difficulte' => 'required',
            'type' => 'required',
            'ingredients' => 'required|array',
            'quantites' => 'required|array',
        ]);

        $userId = 3;

        // création de la recette
        $recipe = Recipe::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'temps_preparation' => $request->temps_preparation,
                'temps_cuisson' => $request->temps_cuisson,
                'temps_repos' => $request->temps_repos,
                'temps_total' => $request->temps_total,
                'portion' => $request->portion,
                'difficulte' => $request->difficulte,
                'type' => $request->type,
                'user_id' => $userId,
        ]);

        // ajout des ingrédients avec les quantités
        foreach ($request->ingredients as $ingredientId) {
            $quantite = $request->quantites[$ingredientId] ?? null; // Récupérer la quantité pour cet ingrédient
            $recipe->ingredients()->attach($ingredientId, ['quantite' => $quantite]);
        }

        return redirect()->route('recettes.show', $recipe->id);
    }

    // Afficher le formulaire de modification d'une recette
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        $ingredients = Ingredient::all();

        return view('recettes.edit', compact('recipe', 'ingredients'));
    }

    // Mettre à jour une recette
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'temps_preparation' => 'required|integer',
            'ingredients' => 'required|array',
            'quantites' => 'required|array'
        ]);
    
        // Récupérer la recette à modifier
        $recipe = Recipe::findOrFail($id);
    
        // Mettre à jour les champs de la recette
        $recipe->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'temps_preparation' => $request->input('temps_preparation'),
            'temps_cuisson' => $request->input('temps_cuisson'),
            'temps_repos' => $request->input('temps_repos'),
            'temps_total' => $request->input('temps_total'),
            'portion' => $request->input('portion'),
            'difficulte' => $request->input('difficulte'),
            'type' => $request->input('type'),
        ]);
    
        // Mettre à jour les ingrédients associés avec leurs quantités
        $ingredients = [];
        foreach ($request->input('ingredients') as $ingredientId) {
            $ingredients[$ingredientId] = ['quantite' => $request->input('quantites')[$ingredientId]];
        }
        $recipe->ingredients()->sync($ingredients);
    
        // Rediriger vers la page de la recette avec un message de succès
        return redirect()->route('recettes.show', $recipe->id)->with('success', 'Recette mise à jour avec succès.');
    }    

    // Supprimer une recette
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect()->route('recettes.index')->with('success', 'La recette a bien été supprimée');
    }
}
