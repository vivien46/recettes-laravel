<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

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
        $query = $request->get('q');
        $ingredients = Ingredient::where('nom', 'ILIKE', "%{$query}%")->get();
        return response()->json($ingredients);
    }

}
