<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

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
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'date_naissance' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', 'Profil mis à jour avec succès');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
