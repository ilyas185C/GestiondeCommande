@extends('layouts.master')

@section('title', 'Détails du Produit')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-box fa-fw me-2"></i>Détails du Produit
        </h1>
        <div>
            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Modifier
            </a>
            <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations du produit</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">ID:</div>
                        <div class="col-sm-9">{{ $produit->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nom:</div>
                        <div class="col-sm-9">{{ $produit->nom }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catégories:</div>
                        <div class="col-sm-9">
                            @forelse($produit->categories as $categorie)
                                <span class="badge bg-primary me-1">{{ $categorie->nom }}</span>
                            @empty
                                <span class="text-muted">Aucune catégorie</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Prix Unitaire:</div>
                        <div class="col-sm-9">{{ number_format($produit->prix_unitaire, 2) }} €</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Stock:</div>
                        <div class="col-sm-9">
                            <span class="badge @if($produit->stock > 10) bg-success @elseif($produit->stock > 0) bg-warning text-dark @else bg-danger @endif">
                                {{ $produit->stock }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Description:</div>
                        <div class="col-sm-9">{{ $produit->description }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Date création:</div>
                        <div class="col-sm-9">{{ $produit->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 font-weight-bold">Dernière modification:</div>
                        <div class="col-sm-9">{{ $produit->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="text-muted small">Commandes totales</div>
                        <div class="h2 font-weight-bold text-primary">{{ $produit->commandes->count() }}</div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small">Quantité vendue</div>
                        <div class="h4 font-weight-bold">{{ $produit->commandes->sum('pivot.quantite') }}</div>
                    </div>
                    <div>
                        <div class="text-muted small">Chiffre d'affaires</div>
                        <div class="h4 font-weight-bold text-success">
                            {{ number_format($produit->commandes->sum(function($commande) use ($produit) {
                                return $commande->pivot->quantite * $produit->prix_unitaire;
                            }), 2) }} €
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection