<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;

class HomeController extends Controller
{
    /**
     * Afficher le tableau de bord
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer les statistiques de base
        $stats = [
            'total_clients' => Client::count(),
            'total_produits' => Produit::count(),
            'total_commandes' => Commande::count(),
            'total_revenue' => $this->calculateTotalRevenue(),
        ];

        // Commandes par mois (12 derniers mois)
        $commandesParMois = Commande::selectRaw('DATE_FORMAT(date_commande, "%Y-%m") as month, COUNT(*) as count')
            ->where('date_commande', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Clients par mois (12 derniers mois)
        $clientsParMois = Client::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Dernières commandes
        $latestCommandes = Commande::with(['client', 'produits'])
            ->orderBy('date_commande', 'desc')
            ->take(5)
            ->get();

        return view('home', [
            'stats' => $stats,
            'commandesParMois' => $commandesParMois,
            'clientsParMois' => $clientsParMois,
            'latestCommandes' => $latestCommandes
        ]);
    }

    /**
     * Calculer le chiffre d'affaires total
     *
     * @return float
     */
    protected function calculateTotalRevenue()
    {
        return Commande::with('produits')->get()->sum(function($commande) {
            return $commande->produits->sum(function($produit) {
                return $produit->pivot->quantite * $produit->prix_unitaire;
            });
        });
    }
}
