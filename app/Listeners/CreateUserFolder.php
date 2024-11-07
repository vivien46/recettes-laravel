<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\Storage;

class CreateUserFolder
{
    /**
     * handle the event listener.
     * 
     * @param UserRegistered $event
     * @return void
     * 
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        // Définit le chemin du dossier de l'utilisateur
        $userFolderPath = 'Users/Profiles/' . $user->pseudo;

        // Crée le dossier de l'utilisateur dans le stockage public si il n'existe pas
        Storage::disk('public')->makeDirectory($userFolderPath);
    }
}
