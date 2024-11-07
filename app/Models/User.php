<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $table = 'users';

    protected $fillable = [
        'nom',
        'prenom',
        'pseudo',
        'date_naissance',
        'email',
        'mot_de_passe',
        'role',
        'profil_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_naissance' => 'date',
        ];
    }

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function setRoleAttribute($value)
    {
        $allowedRoles = ['user', 'admin'];

        if (in_array($value, $allowedRoles)) {
            $this->attributes['role'] = $value;
        } else {
            $this->attributes['role'] = 'user';
        }

    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
