<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description'
    ];

    // Relation many-to-many avec Produit
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'categorie_produit')
                    ->withTimestamps();
    }
}