<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix_unitaire',
        'description',
        'stock',
        // Retirez 'categorie_id' car nous utilisons désormais une table pivot
    ];

    // Relation many-to-many avec Catégorie
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_produit')
                    ->withTimestamps();
    }

    // Relation many-to-many avec Commande
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}