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

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Total Clients Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Clients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_clients'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Produits Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Produits</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_produits'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Commandes Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Commandes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_commandes'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chiffre d'Affaires Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Chiffre d'Affaires</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_revenue'], 2) }} €</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
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

        <!-- Charts Row -->
        <div class="row mb-4">
            <!-- Commandes par Mois Chart -->
            <div class="col-xl-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Commandes par Mois</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="commandesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clients par Mois Chart -->
            <div class="col-xl-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Clients par Mois</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="clientsChart"></canvas>
                        </div>
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

            <!-- Dernières Commandes Card -->
            <div class="col-xl-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dernières Commandes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestCommandes as $commande)
                                    <tr>
                                        <td>{{ $commande->id }}</td>
                                        <td>{{ $commande->client->nom }}</td>
                                        <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                        <td>{{ number_format($commande->produits->sum(function($p) { return $p->pivot->quantite * $p->prix_unitaire; }), 2) }} €</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

        .chart-area {
            position: relative;
            height: 250px;
            width: 100%;
        }
    </style>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Commandes par Mois Chart
        const commandesCtx = document.getElementById('commandesChart').getContext('2d');
        const commandesChart = new Chart(commandesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($commandesParMois->pluck('month')) !!},
                datasets: [{
                    label: 'Commandes',
                    data: {!! json_encode($commandesParMois->pluck('count')) !!},
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Clients par Mois Chart
        const clientsCtx = document.getElementById('clientsChart').getContext('2d');
        const clientsChart = new Chart(clientsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($clientsParMois->pluck('month')) !!},
                datasets: [{
                    label: 'Clients',
                    data: {!! json_encode($clientsParMois->pluck('count')) !!},
                    backgroundColor: 'rgba(28, 200, 138, 0.7)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection
