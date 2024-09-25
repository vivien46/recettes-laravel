<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    // Nom de la table
    protected $fillable = ['titre', 'description', 'temps_preparation', 'temps_cuisson', 'temps_repos', 'temps_total', 'portion', 'difficulte', 'type', 'user_id', 'imageUrl'];

    // Relation avec Ingredients
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient')
                    ->withPivot('quantite')
                    ->withTimestamps();;
    }

    // Relation avec Steps
    public function steps()
    {
        return $this->hasMany(Step::class, 'recipe_id', 'id')->orderBy('order', 'asc');
    }

}
