<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;
    public $countdown;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($url, $user)
    {
        $this->url = $url;
        $this->user = $user;
        $this->countdown = config('auth.passwords.users.expire');
        $this->email = $user->email;
    }

    /**
     * Build the message.
     */
    public function build(): ResetPasswordMail
    {
         return $this->subject('Réinitialisation de votre mot de passe')
                        ->view('auth.passwords.email')
                        ->with([
                            'pseudo' => $this->user->pseudo,
                            'url' => $this->url,
                            'countdown' => $this->countdown,
                            'email' => $this->email,
            ]);
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Reset Password Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
