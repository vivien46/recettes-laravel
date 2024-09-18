<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // Nom de la table
    protected $fillable = ['nom', 'description'];
    
    // Relation avec Recipes
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredient')
                    ->withPivot('quantite')
                    ->withTimestamps();;
    }
}
