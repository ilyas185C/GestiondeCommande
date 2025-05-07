<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeProduitController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'produits'])->latest()->paginate(10);
        return view('commande-produit.index', compact('commandes'));
    }

    public function create()
    {
        $commandes = Commande::with('client')->get();
        $produits = Produit::all();
        return view('commande-produit.create', compact('commandes', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $commande = Commande::findOrFail($request->commande_id);
        $produit = Produit::findOrFail($request->produit_id);
        
        // Vérifier si le produit est déjà associé à cette commande
        if ($commande->produits()->where('produit_id', $produit->id)->exists()) {
            return redirect()->route('commande-produit.create')
                ->with('error', 'Ce produit est déjà associé à cette commande. Veuillez utiliser l\'option de modification.');
        }
        
        // Vérifier si la quantité est disponible en stock
        if ($produit->stock < $request->quantite) {
            return redirect()->route('commande-produit.create')
                ->with('error', 'Stock insuffisant pour ce produit.');
        }
        
        $commande->produits()->attach($produit->id, ['quantite' => $request->quantite]);
        
        // Mettre à jour le stock du produit
        $produit->stock -= $request->quantite;
        $produit->save();

        return redirect()->route('commande-produit.index')
            ->with('success', 'Produit ajouté à la commande avec succès.');
    }

    public function edit($commande_id, $produit_id)
    {
        $commande = Commande::findOrFail($commande_id);
        $produit = Produit::findOrFail($produit_id);
        $pivot = $commande->produits()->where('produit_id', $produit_id)->first()->pivot;
        
        return view('commande-produit.edit', compact('commande', 'produit', 'pivot'));
    }

    public function update(Request $request, $commande_id, $produit_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $commande = Commande::findOrFail($commande_id);
        $produit = Produit::findOrFail($produit_id);
        
        // Récupérer l'ancienne quantité
        $ancienneQuantite = $commande->produits()->where('produit_id', $produit_id)->first()->pivot->quantite;
        
        // Calculer la différence de quantité
        $difference = $request->quantite - $ancienneQuantite;
        
        // Vérifier si le stock est suffisant en cas d'augmentation
        if ($difference > 0 && $produit->stock < $difference) {
            return redirect()->route('commande-produit.edit', [$commande_id, $produit_id])
                ->with('error', 'Stock insuffisant pour augmenter la quantité.');
        }
        
        // Mettre à jour la quantité dans la relation pivot
        $commande->produits()->updateExistingPivot($produit_id, ['quantite' => $request->quantite]);
        
        // Mettre à jour le stock du produit
        $produit->stock -= $difference;
        $produit->save();

        return redirect()->route('commande-produit.index')
            ->with('success', 'Quantité mise à jour avec succès.');
    }

    public function destroy($commande_id, $produit_id)
    {
        $commande = Commande::findOrFail($commande_id);
        $produit = Produit::findOrFail($produit_id);
        
        // Récupérer la quantité avant suppression
        $quantite = $commande->produits()->where('produit_id', $produit_id)->first()->pivot->quantite;
        
        // Détacher le produit de la commande
        $commande->produits()->detach($produit_id);
        
        // Remettre la quantité en stock
        $produit->stock += $quantite;
        $produit->save();

        return redirect()->route('commande-produit.index')
            ->with('success', 'Produit retiré de la commande avec succès.');
    }
}
