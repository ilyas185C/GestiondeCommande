@extends('layouts.master')

@section('title', 'Tableau de Bord')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
            <div class="d-none d-sm-inline-block">
                <span class="badge bg-primary p-2">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ now()->format('d/m/Y') }}
                </span>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="card shadow mb-4 border-0 bg-primary text-white">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-1"><i class="fas fa-hand-wave"></i> Bienvenue !</h2>
                        <p class="mb-0">Cette application vous permet de gérer efficacement vos clients, produits,
                            catégories et commandes.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <i class="fas fa-store-alt fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="row">
            <!-- Clients Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-primary border-4 shadow h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Clients</h5>
                            <p class="card-text text-muted">Gestion de votre clientèle</p>
                            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-arrow-right me-1"></i> Accéder
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catégories Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-success border-4 shadow h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-tags fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Catégories</h5>
                            <p class="card-text text-muted">Organisation par catégories</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-arrow-right me-1"></i> Accéder
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produits Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-info border-4 shadow h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-box-open fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Produits</h5>
                            <p class="card-text text-muted">Gestion du catalogue</p>
                            <a href="{{ route('produits.index') }}" class="btn btn-sm btn-info">
                                <i class="fas fa-arrow-right me-1"></i> Accéder
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commandes Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-warning border-4 shadow h-100">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-shopping-cart fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Commandes</h5>
                            <p class="card-text text-muted">Suivi des commandes</p>
                            <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-arrow-right me-1"></i> Accéder
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Row -->
        <div class="row">
            <!-- Affectation Card -->
            <div class="col-xl-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-link fa-3x text-purple mb-3"></i>
                        <h5 class="card-title">Affectation Produits-Commandes</h5>
                        <p class="card-text text-muted">Lier les produits aux commandes</p>
                        <a href="{{ route('commande-produit.index') }}" class="btn btn-purple">
                            <i class="fas fa-arrow-right me-1"></i> Gérer les affectations
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Recherche Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-search me-2"></i> Outils de Recherche
                </h6>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="feature-icon bg-info bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
                            <i class="fas fa-user-tag fa-2x"></i>
                        </div>
                        <h5>Commandes par Client</h5>
                        <a href="{{ route('recherche.commandes-par-client') }}" class="btn btn-outline-info">
                            Accéder <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="feature-icon bg-warning bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h5>Montant par Période</h5>
                        <a href="{{ route('recherche.montant-par-periode') }}" class="btn btn-outline-warning">
                            Accéder <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-icon bg-success bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
                            <i class="fas fa-chart-pie fa-2x"></i>
                        </div>
                        <h5>Statistiques Produits</h5>
                        <a href="{{ route('recherche.statistiques-produit') }}" class="btn btn-outline-success">
                            Accéder <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-purple {
            background-color: #6f42c1;
            color: white;
        }

        .btn-purple:hover {
            background-color: #5a32a3;
            color: white;
        }

        .feature-icon {
            transition: transform 0.3s;
        }

        .feature-icon:hover {
            transform: scale(1.1);
        }
    </style>
@endsection
