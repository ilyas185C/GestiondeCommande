<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('client')->latest()->paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('commandes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'etat_commande' => 'required|in:en cours,terminée,annulée',
        ]);

        Commande::create([
            'client_id' => $request->client_id,
            'date_commande' => $request->date_commande,
            'etat_commande' => $request->etat_commande,
        ]);

        return redirect()->route('commandes.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $commande->load('client', 'produits');
        return view('commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        $clients = Client::all();
        return view('commandes.edit', compact('commande', 'clients'));
    }

    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'etat_commande' => 'required|in:en cours,terminée,annulée',
        ]);

        $commande->update($request->all());

        return redirect()->route('commandes.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}