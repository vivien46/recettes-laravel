<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->mot_de_passe])) {
            return redirect()->route('recettes.index')->with('success', 'Connexion réussie !'); 
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects',
            'mot_de_passe' => 'Mot de passe incorrect',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }
}
