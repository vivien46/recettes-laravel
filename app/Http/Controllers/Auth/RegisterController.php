<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailFrench;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Events\UserRegistered;
use App\Notifications\VerifyEmailNotification;

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
       ],[
            'nom.required' => 'Le champ nom est obligatoire.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'pseudo.required' => 'Le champ pseudo est obligatoire.',
            'pseudo.unique' => 'Ce pseudo est déjà pris.',
            'date_naissance.required' => 'Le champ date de naissance est obligatoire.',
            'email.required' => "Le champ email est obligatoire.",
            'email.email' => "Le format de l'email est invalide.",
            'email.unique' => "Cet email est déjà utilisé.",
            'mot_de_passe.required' => 'Le champ mot de passe est obligatoire.',
            'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'mot_de_passe.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
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

        // Envoyer l'email de notificaton
        $user->notify(new VerifyEmailNotification($user));

        // Déclancher un événement pour créer le dossier de l'utilisateur
        event(new UserRegistered($user));

        return redirect()->route('login')->with('success', 'Veuillez activer votre compte avant de vous connecter.');
    }
}
