
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeProduitController;
use App\Http\Controllers\RechercheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route d'accueil// Route d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Routes pour les clients
Route::resource('clients', ClientController::class);

// Routes pour les catégories
Route::resource('categories', CategorieController::class);

// Routes pour les produits
Route::resource('produits', ProduitController::class);

// Routes pour les commandes
Route::resource('commandes', CommandeController::class);

// Routes pour l'affectation commande-produit
Route::get('/commande-produit', [CommandeProduitController::class, 'index'])->name('commande-produit.index');
Route::get('/commande-produit/create', [CommandeProduitController::class, 'create'])->name('commande-produit.create');
Route::post('/commande-produit', [CommandeProduitController::class, 'store'])->name('commande-produit.store');
Route::get('/commande-produit/{commande}/{produit}/edit', [CommandeProduitController::class, 'edit'])->name('commande-produit.edit');
Route::put('/commande-produit/{commande}/{produit}', [CommandeProduitController::class, 'update'])->name('commande-produit.update');
Route::delete('/commande-produit/{commande}/{produit}', [CommandeProduitController::class, 'destroy'])->name('commande-produit.destroy');

// Routes pour les recherches
Route::get('/recherche/commandes-par-client', [RechercheController::class, 'commandesParClient'])->name('recherche.commandes-par-client');
Route::post('/recherche/commandes-par-client', [RechercheController::class, 'rechercherCommandesParClient'])->name('recherche.commandes-par-client.rechercher');

Route::get('/recherche/montant-par-periode', [RechercheController::class, 'montantParPeriode'])->name('recherche.montant-par-periode');
Route::post('/recherche/montant-par-periode', [RechercheController::class, 'rechercherMontantParPeriode'])->name('recherche.montant-par-periode.rechercher');

Route::get('/recherche/statistiques-produit', [RechercheController::class, 'statistiquesProduit'])->name('recherche.statistiques-produit');