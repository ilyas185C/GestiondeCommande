@extends('layouts.master')

@section('title', 'Détails de la Commande')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-shopping-cart fa-fw me-2"></i>Commande #{{ $commande->id }}
        </h1>
        <div>
            <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning btn-sm me-2">
                <i class="fas fa-edit fa-sm me-1"></i> Modifier
            </a>
            <a href="{{ route('commandes.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
                    <span class="badge 
                        @if($commande->etat_commande == 'terminée') bg-success
                        @elseif($commande->etat_commande == 'en cours') bg-warning text-dark
                        @else bg-danger @endif">
                        {{ ucfirst($commande->etat_commande) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="text-primary">Client</h5>
                        <p class="mb-1"><strong>Nom:</strong> {{ $commande->client->nom }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $commande->client->email ?? 'Non renseigné' }}</p>
                        <p class="mb-0"><strong>Téléphone:</strong> {{ $commande->client->telephone ?? 'Non renseigné' }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-primary">Détails</h5>
                        <p class="mb-1"><strong>Date de commande:</strong> {{ $commande->date_commande->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Créée le:</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mb-0"><strong>Modifiée le:</strong> {{ $commande->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produits commandés ({{ $commande->produits->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($commande->produits->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->produits as $produit)
                                        <tr>
                                            <td>{{ $produit->nom }}</td>
                                            <td>{{ number_format($produit->pivot->prix_unitaire, 2) }} €</td>
                                            <td>{{ $produit->pivot->quantite }}</td>
                                            <td>{{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 2) }} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-light">
                                        <th colspan="3">Total</th>
                                        <th>{{ number_format($commande->produits->sum(function($produit) {
                                            return $produit->pivot->prix_unitaire * $produit->pivot->quantite;
                                        }), 2) }} €</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            Aucun produit associé à cette commande
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection