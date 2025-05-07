<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date_commande',
        'etat_commande',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
    
    // Méthode pour calculer le montant total de la commande
    public function getMontantTotalAttribute()
    {
        $total = 0;
        foreach ($this->produits as $produit) {
            $total += $produit->prix_unitaire * $produit->pivot->quantite;
        }
        return $total;
    }
}
