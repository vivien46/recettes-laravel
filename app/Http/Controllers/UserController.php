<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with(['recipes' => function($query) {
            $query->orderBy('created_at', 'DESC');
        }])->findOrFail($id);

        // Calculer la durée d'inscription
        $dateInscription = $user->created_at;
        $dateNow = now();
        $years = $dateInscription->diffInYears($dateNow) % 12;
        $months = $dateInscription->copy()->addYears($years)->diffInMonths($dateNow) % 12;
        $days = $dateInscription->copy()->addYears($years)->addMonths($months)->diffInDays($dateNow) % 12;

        // Formatage de la durée d'inscription
        $membreDepuis = '';
        if ($years > 0) {
            $membreDepuis .= $years . ' ' . Str::plural('année ', $years);
        }
        if ($months > 0) {
            $membreDepuis .= $months . ' ' . Str::plural('mois ', $months);
        }
        if ($days > 0) {
            $membreDepuis .= ' et ' . $days . ' ' . Str::plural('jour', $days);
        }

        if ($years == 0 && $months == 0 && $days == 0) {
            $membreDepuis = 'aujourd\'hui';
        }

        // Pour chaque recette, vérifier si l'image est une image de Picsum
    foreach ($user->recipes as $recipe) {
        if ($recipe->imageUrl && Str::contains($recipe->imageUrl, 'https://picsum.photos/200/300')) {
            // Si l'image est de Picsum, ne pas utiliser asset()
            $recipe->setAttribute('image_display', $recipe->imageUrl);
        } else {
            // Sinon, on utilise asset() pour récupérer l'image depuis le stockage
            $recipe->setAttribute('image_display', asset('storage/' . $recipe->imageUrl));
        }
    }

        return view('users.show', compact('user', 'membreDepuis'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pseudo' => 'required|string|max:255|unique:users,pseudo,' . $id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'date_naissance' => 'required|date',
            'profil_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ], [
            'profil_image.image' => 'Le fichier doit être une image',
            'profil_image.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou webp',
            'profil_image.max' => 'L\'image ne doit pas dépasser 2 Mo',
            'profil_image.dimensions' => 'L\'image doit avoir une taille minimale de 100x100 pixels et maximale de 1000x1000 pixels',
        ]);


        $user = User::findOrFail($id);

        // Gestion de l'image de profil
        if ($request->hasFile('profil_image')) {
            // Supprimer l'ancienne image de profil si elle existe
            if ($user->profil_image) {
                Storage::disk('public')->delete($user->profil_image);
            }

            // Enregistrer la nouvelle image de profil
            $imagePath = $request->file('profil_image')->store('Users/Profiles/' . $user->pseudo, 'public');
            $user->profil_image = $imagePath;
        }

        $user->update($validatedData);
        
        return redirect()->route('users.show', $user->id)->with('success', 'Profil mis à jour avec succès');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
