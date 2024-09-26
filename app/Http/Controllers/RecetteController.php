<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    // Afficher la liste des recettes
    public function index()
    {
        $recipes = Recipe::with(['steps' => function ($query) {
            $query->orderBy('order', 'asc')->get()->each(function ($step) {
                $step->description = str::limit($step->description, 150, '...');
            });
        }])->paginate(10);
        return view('recettes.index', compact('recipes'));
    }

    // Afficher une seule recette
    public function show($id)
    {
        $recipe = Recipe::with(['ingredients' => function ($query) {
            $query->orderBy('recipe_ingredient.id', 'asc');
        }, 'steps' => function ($query) {
            $query->orderBy('order', 'asc');  // Ajoute l'ordre des étapes
        }])->findOrFail($id);
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
       $validate = $request->validate([
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
            'unites' => 'required|array',
            'steps' => 'required|array',
            'order' => 'required|array',
            'imageUrl' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=300,min_height=300,max_width=1500,max_height=1500',
       ],[
            'imageUrl.dimensions' => 'L\'image doit avoir une taille minimale de 300x300 pixels et maximale de 1500x1500 pixels.',
            'imageUrl.image' => 'Le fichier téléchargé doit être une image.',
            'imageUrl.mimes' => 'L\'image doit être de type jpeg, png, jpg ou webp.',
            'imageUrl.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        $userId = 3;

        // Enregistrement de l'image
        $imagePath = null;
        if ($request->hasFile('imageUrl')) {
            $imagePath = $request->file('imageUrl')->store('recettes', 'public');
        }

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
            'imageUrl' => $imagePath,
        ]);

        // ajout des ingrédients avec les quantités
        foreach ($request->ingredients as $ingredientId) {
            // Récupérer la quantité et l'unité
            $quantite = $request->quantites[$ingredientId] ?? null;
            $unite = $request->unites[$ingredientId] ?? null;

            if ($quantite && $unite) {
                // Manipulation des unités en fonction de la quantité
                if ($quantite > 1) {
                    switch ($unite) {
                        case "cuillère à soupe":
                        case "cuillère à café":
                            $unite = "cuillères à " . explode(' ', $unite)[2];
                            break;
                        case "unité":
                            $unite = "unités";
                            break;
                        case "feuille":
                            $unite = "feuilles";
                            break;
                        case "tranche":
                            $unite = "tranches";
                            break;
                            // Pas de modification pour les autres unités (g, kg, ml, etc.)
                        default:
                            break;
                    }
                }
                // Concaténer la quantité et l'unité
                $quantite_avec_unite = $quantite . ' ' . $unite;

                // Attacher l'ingrédient à la recette
                $recipe->ingredients()->attach($ingredientId, ['quantite' => $quantite_avec_unite]);
            }
        }

        // Ajout des étapes à la recette
        foreach ($request->steps as $stepId => $stepDescription) {
            $ordre = $request->order[$stepId];
            $recipe->steps()->create([
                'description' => $stepDescription,
                'order' => $ordre,
            ]);
        }

        return redirect()->route('recettes.show', $recipe->id)->with('success', 'Recette créée avec succès.');
    }

    // Afficher le formulaire de modification d'une recette
    public function edit($id)
    {
        $recipe = Recipe::with(['ingredients' => function ($query) {
            $query->orderBy('recipe_ingredient.id', 'asc');
        }, 'steps' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->findOrFail($id);

        $ingredients = Ingredient::all();

        // Parcourir chaque ingrédient pour séparer la quantité et l'unité
        foreach ($recipe->ingredients as $ingredient) {
            if (preg_match('/(\d+)\s*(.*)/', $ingredient->pivot->quantite, $matches)) {
                $ingredient->pivot->quantite_numeric = $matches[1]; // La partie numérique de la quantité
                $ingredient->pivot->quantite_unite = $matches[2];   // L'unité (g, kg, etc.)
            } else {
                $ingredient->pivot->quantite_numeric = $ingredient->pivot->quantite; // Si pas d'unité, mettre toute la quantité
                $ingredient->pivot->quantite_unite = ''; // Pas d'unité trouvée
            }
        }

        return view('recettes.edit', compact('recipe', 'ingredients'));
    }

    // Mettre à jour une recette
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'temps_preparation' => 'required|integer',
            'temps_cuisson' => 'required|integer',
            'temps_repos' => 'required|integer',
            'temps_total' => 'required|integer',
            'portion' => 'required|integer',
            'difficulte' => 'required|string',
            'type' => 'required|string',
            'ingredients' => 'required|array',
            'quantites' => 'required|array',
            'unites' => 'required|array',
            'steps' => 'required|array',
            'order' => 'required|array',
            'imageUrl' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=300,min_height=300,max_width=1500,max_height=1500',
       ],[
            'imageUrl.dimensions' => 'L\'image doit avoir une taille minimale de 300x300 pixels et maximale de 1500x1500 pixels.',
            'imageUrl.image' => 'Le fichier téléchargé doit être une image.',
            'imageUrl.mimes' => 'L\'image doit être de type jpeg, png, jpg ou webp.',
            'imageUrl.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        // Récupérer la recette à modifier
        $recipe = Recipe::findOrFail($id);

        // Gestion de l'upload de l'image
        if ($request->hasFile('imageUrl')) {
            // Supprime l'ancienne image si elle existe
            if ($recipe->imageUrl) {
                Storage::disk('public')->delete($recipe->imageUrl);
            }

            // Enregistre la nouvelle image
            $imagePath = $request->file('imageUrl')->store('recettes', 'public');
            $recipe->imageUrl = $imagePath;
        }

        // Mettre à jour les champs de la recette
        $recipe->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'temps_preparation' => $validated['temps_preparation'],
            'temps_cuisson' => $validated['temps_cuisson'],
            'temps_repos' => $validated['temps_repos'],
            'temps_total' => $validated['temps_total'],
            'portion' => $validated['portion'],
            'difficulte' => $validated['difficulte'],
            'type' => $validated['type'],
        ]);

        // Mettre à jour les ingrédients
        $recipe->ingredients()->detach();
    foreach ($validated['ingredients'] as $ingredientId) {
        $quantite = $validated['quantites'][$ingredientId] ?? null;
        $unite = $validated['unites'][$ingredientId] ?? null;

        if ($quantite && $unite) {
            $quantite_avec_unite = $quantite . ' ' . $unite;
            $recipe->ingredients()->attach($ingredientId, ['quantite' => $quantite_avec_unite]);
        }
    }

        // Mettre à jour les étapes
        $recipe->steps()->delete();
        foreach ($validated['steps'] as $index => $stepDescription) {
            $recipe->steps()->create([
                'description' => $stepDescription,
                'order' => $validated['order'][$index],
            ]);
        }

        // Rediriger vers la page de la recette avec un message de succès
        return redirect()->route('recettes.show', $recipe->id)->with('success', 'Recette mise à jour avec succès.');
    }

    // Supprimer une recette
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($recipe->imageUrl) {
            Storage::disk('public')->delete($recipe->imageUrl);
        }

        $recipe->delete();

        return redirect()->route('recettes.index')->with('success', 'La recette a bien été supprimée');
    }
}
