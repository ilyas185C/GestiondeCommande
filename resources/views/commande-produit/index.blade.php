@extends('layouts.master')

@section('title', 'Gestion Commande-Produit')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-link"></i> Gestion des Commandes-Produits
        </h1>
        <a href="{{ route('commande-produit.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un Produit à une Commande
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Commandes avec Produits</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Commande</th>
                            <th>Client</th>
                            <th>Téléphone</th>
                            <th>État</th>
                            <th>Produits</th>
                            <th>Quantité Totale</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->client->nom }}</td>
                            <td>{{ $commande->client->telephone ?? 'N/A' }}</td>
                            <td>
                                @switch($commande->etat_commande)
                                    @case('terminée')
                                        <span class="badge text-dark border border-dark bg-white">En attente</span> <!-- Texte rouge, fond blanc, bordure rouge -->
                                        @break
                                    @case('cours')
                                        <span class="badge text-dark border border-dark bg-white">En cours</span>
                                        @break
                                    @case('annulee')
                                        <span class="badge text-dark border border-dark bg-white">Annulée</span>
                                        @break
                                    @default
                                        <span class="badge text-dark border border-dark bg-white">{{ $commande->etat_commande }}</span>
                                @endswitch
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($commande->produits as $produit)
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span>
                                            <strong>{{ $produit->nom }}</strong>

                                             {{ number_format($produit->prix_unitaire, 2) }} €
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="font-weight-bold">
                                {{ $commande->produits->sum('pivot.quantite') }}
                            </td>
                            <td class="font-weight-bold">
                                {{ number_format($commande->produits->sum(function($produit) {
                                    return $produit->pivot->quantite * $produit->prix_unitaire;
                                }), 2) }} €
                            </td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    @foreach($commande->produits as $produit)
                                    <div class="me-2 mb-2 d-flex flex-column">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('commande-produit.edit', [$commande->id, $produit->id]) }}"
                                               class="btn btn-outline-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('commande-produit.destroy', [$commande->id, $produit->id]) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                        title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <small class="text-muted text-center">{{ $produit->pivot->quantite }} unités</small>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucune commande avec produits trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($commandes->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $commandes->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
