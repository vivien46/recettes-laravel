<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function create($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // dd($request->only('email', 'mot_de_passe', 'token'));
        // dd($request->all());

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'mot_de_passe' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé avec succès!');
        } else {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse e-mail.']);
        }

    }
                
}
