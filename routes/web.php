<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeProduitController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes d'authentification
Route::middleware('guest')->group(function () {
    // Connexion
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

    // Enregistrement
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // Réinitialisation du mot de passe
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    // Page d'accueil
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Ressources CRUD
    Route::resources([
        'clients' => ClientController::class,
        'categories' => CategorieController::class,
        'produits' => ProduitController::class,
        'commandes' => CommandeController::class,
    ]);

    // Gestion des produits dans les commandes
    Route::prefix('commande-produit')->group(function () {
        Route::get('/', [CommandeProduitController::class, 'index'])->name('commande-produit.index');
        Route::get('/create', [CommandeProduitController::class, 'create'])->name('commande-produit.create');
        Route::post('/', [CommandeProduitController::class, 'store'])->name('commande-produit.store');
        Route::get('/{commande}/{produit}/edit', [CommandeProduitController::class, 'edit'])->name('commande-produit.edit');
        Route::put('/{commande}/{produit}', [CommandeProduitController::class, 'update'])->name('commande-produit.update');
        Route::delete('/{commande}/{produit}', [CommandeProduitController::class, 'destroy'])->name('commande-produit.destroy');
    });

    // Routes de recherche
    Route::prefix('recherche')->group(function () {
        Route::get('/commandes-par-client', [RechercheController::class, 'commandesParClient'])->name('recherche.commandes-par-client');
        Route::post('/commandes-par-client', [RechercheController::class, 'rechercherCommandesParClient'])->name('recherche.commandes-par-client.rechercher');

        Route::get('/montant-par-periode', [RechercheController::class, 'montantParPeriode'])->name('recherche.montant-par-periode');
        Route::post('/montant-par-periode', [RechercheController::class, 'rechercherMontantParPeriode'])->name('recherche.montant-par-periode.rechercher');

        Route::get('/statistiques-produit', [RechercheController::class, 'statistiquesProduit'])->name('recherche.statistiques-produit');
        Route::get('/telecharger', [RechercheController::class, 'telecharger'])->name('recherche.telecharger');
    });
});
Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client/accueil', [ClientController::class, 'accueil'])->name('client.accueil');
});
