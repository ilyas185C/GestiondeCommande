<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RechercheController extends Controller
{
    // Méthode unifiée pour les commandes par client
    public function commandesParClient(Request $request)
    {
        $clients = Client::orderBy('nom')->get();
        $commandes = collect();
        $clientId = $request->client_id;

        if ($clientId) {
            $commandes = Commande::with(['produits', 'client'])
                ->where('client_id', $clientId)
                ->latest('date_commande')
                ->get();
        }

        return view('recherche.commandes-par-client', [
            'clients' => $clients,
            'commandes' => $commandes,
            'clientSelectionne' => $clientId
        ]);
    }

    // Méthode optimisée pour le montant par période
    public function montantParPeriode(Request $request)
    {
        $annees = Commande::selectRaw('DISTINCT YEAR(date_commande) as annee')
            ->orderBy('annee', 'desc')
            ->pluck('annee');

        $data = [
            'annees' => $annees,
            'etats' => ['en cours', 'terminée', 'annulée']
        ];

        if ($request->filled(['annee', 'mois', 'etat_commande'])) {
            $debut = Carbon::create($request->annee, $request->mois, 1)->startOfMonth();
            $fin = $debut->copy()->endOfMonth();

            $commandes = Commande::with(['produits', 'client'])
                ->whereBetween('date_commande', [$debut, $fin])
                ->where('etat_commande', $request->etat_commande)
                ->get();

            $data += [
                'commandes' => $commandes,
                'montantTotal' => $commandes->sum('montant_total'),
                'request' => $request->all()
            ];
        }

        return view('recherche.montant-par-periode', $data);
    }

    // Méthode pour les statistiques produits
    public function statistiquesProduit()
    {
        $statistiques = DB::table('commande_produit')
            ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
            ->join('commandes', 'commandes.id', '=', 'commande_produit.commande_id')
            ->whereNotIn('commandes.etat_commande', ['annulée'])
            ->select([
                'produits.id',
                'produits.nom',
                'produits.prix_unitaire',
                DB::raw('SUM(commande_produit.quantite) as quantite_totale'),
                DB::raw('SUM(commande_produit.quantite * produits.prix_unitaire) as chiffre_affaires')
            ])
            ->groupBy('produits.id', 'produits.nom', 'produits.prix_unitaire')
            ->orderByDesc('chiffre_affaires')
            ->get();

        return view('recherche.statistiques-produit', compact('statistiques'));
    }
}
