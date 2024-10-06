<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::orderBy('created_at')->paginate(10);
        return view('ingredients.index', compact('ingredients'));
    }
    
    public function create()
    {
        return view('ingredients.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Ingredient::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient créé avec succès');

    }

    public function show($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingrédient modifié avec succès');
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingrédient supprimé avec succès');
    }

    public function search(Request $request)
{
    // Log la requête pour voir si le paramètre 'q' est bien reçu
    Log::info('Requête reçue pour la recherche d\'ingrédients', $request->all());

    $query = $request->get('q');

    // Log la valeur du paramètre 'q'
    Log::info('Paramètre q:', ['query' => $query]);

    // Vérifier si la requête est mal formée ou vide
    if (empty($query)) {
        Log::error('Le terme de recherche est manquant ou incorrect.');
        return response()->json(['message' => 'Le terme de recherche est manquant ou incorrect.'], 400);
    }

    // Effectuer la recherche
    $ingredients = Ingredient::where('nom', 'ILIKE', "%{$query}%")->get();

    // Log les résultats de la recherche
    Log::info('Résultats de la recherche:', ['ingredients' => $ingredients]);

    // Vérifier si des résultats ont été trouvés
    if ($ingredients->isEmpty()) {
        Log::warning('Aucun ingrédient trouvé pour la recherche : ' . $query);
        return response()->json(['message' => 'Aucun ingrédient trouvé.'], 404);
    }

    // Retourner les résultats trouvés sous forme de tableau JSON
    return response()->json($ingredients);
}


}
