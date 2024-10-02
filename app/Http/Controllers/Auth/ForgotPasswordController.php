<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if($user){
            $token = Password::createToken($user);

            $url = route('password.reset', ['token' => $token, 'email' => $user->email]);

            Mail::to($user->email)->send(new ResetPasswordMail($url, $user));   
        

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // if ($status === Password::RESET_LINK_SENT) {
        //     $user = User::where('email', $request->email)->first();
        //     $token = Password::createToken($user);

        //     $data = [
        //         'pseudo' => $user->pseudo,
        //         'email' => $user->email,
        //         'url' => route('password.reset', $token),
        //         'countdown' => config('auth.passwords.users.expire') * 60,
        //     ];

        //     Mail::send('auth.passwords.email', $data, function ($message) use ($user) {
        //         $message->to($user->email);
        //         $message->subject('Réinitialisation de votre mot de passe');
        //         $message->body(view('auth.passwords.email', compact('user'))->render(), 'text/html');
        //     });

            return back()->with(['success' =>'Le lien de réinitialisation de votre mot de passe a été envoyé par e-mail!']);
        }

        return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse e-mail.']);
    }
}
