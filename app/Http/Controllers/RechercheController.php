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
    public function telecharger()
    {
        // Récupérer les statistiques exactement de la même manière que dans la méthode statistiquesProduit
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

        // Créez un fichier CSV
        $filename = 'statistiques_produits_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($statistiques) {
            $file = fopen('php://output', 'w');
            // Ajoutez l'en-tête UTF-8 BOM pour une compatibilité Excel
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // En-têtes
            fputcsv($file, ['Produit', 'Prix Unitaire (€)', 'Quantité Vendue', 'Chiffre d\'Affaires (€)', 'Pourcentage']);

            // Calculer le total pour le pourcentage
            $totalChiffreAffaires = $statistiques->sum('chiffre_affaires');

            // Données
            foreach ($statistiques as $stat) {
                $pourcentage = round(($stat->chiffre_affaires / $totalChiffreAffaires) * 100, 1);
                fputcsv($file, [
                    $stat->nom,
                    number_format($stat->prix_unitaire, 2, ',', ''),
                    $stat->quantite_totale,
                    number_format($stat->chiffre_affaires, 2, ',', ''),
                    $pourcentage . '%'
                ]);
            }

            // Ligne de total
            fputcsv($file, [
                'Total Général',
                '',
                '',
                number_format($totalChiffreAffaires, 2, ',', ''),
                '100%'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
