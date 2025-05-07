@extends('layouts.master')

@section('title', 'Détails Association Commande-Produit')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-eye fa-fw me-2"></i>Détails de l'association
        </h1>
        <div>
            <a href="{{ route('commande-produit.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour
            </a>
            <a href="{{ route('commande-produit.edit', [$commandeProduit->commande_id, $commandeProduit->produit_id]) }}" 
               class="btn btn-warning">
                <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Modifier
            </a>
        </div>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations détaillées</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Informations Commande</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID Commande:</strong> {{ $commandeProduit->commande->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Client:</strong> {{ $commandeProduit->commande->client->nom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date Commande:</strong> {{ $commandeProduit->commande->date_commande->format('d/m/Y') }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Informations Produit</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Produit:</strong> {{ $commandeProduit->produit->nom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Quantité:</strong> {{ $commandeProduit->quantite }}
                        </li>
                        <li class="list-group-item">
                            <strong>Prix Unitaire:</strong> {{ number_format($commandeProduit->prix_unitaire, 2) }} €
                        </li>
                        <li class="list-group-item">
                            <strong>Total:</strong> {{ number_format($commandeProduit->prix_unitaire * $commandeProduit->quantite, 2) }} €
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection