<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailFrench;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Events\UserRegistered;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
       $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255|unique:users',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:users',
            'mot_de_passe' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'pseudo' => $request->pseudo,
            'date_naissance' => $request->date_naissance,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
            'role' => 'user',
        ]);

        // Envoyer l'email de vérification personnalisé
        Mail::to($user->email)->send(new VerifyEmailFrench($user));

        // Déclancher un événement pour créer le dossier de l'utilisateur
        event(new UserRegistered($user));

        return redirect()->route('login')->with('success', 'Veuillez activer votre compte avant de vous connecter.');
    }
}
