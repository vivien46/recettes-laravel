<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class VerifyEmailFrench extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // Générer le lien de vérification d'email
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
        );

        return $this->subject('Vérification de l\'adresse email')
                    ->markdown('emails.verify-email-french')
                    ->with([
                        'url' => $verificationUrl,
                        'user' => $this->user,
                    ]);
    }
}
