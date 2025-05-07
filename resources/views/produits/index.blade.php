@extends('layouts.master')

@section('title', 'Gestion des Produits')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-boxes fa-fw me-2"></i>Gestion des Produits
        </h1>
        <a href="{{ route('produits.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle fa-sm text-white-50 me-1"></i> Nouveau Produit
        </a>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des produits</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Catégories</th>
                            <th>Prix Unitaire</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produits as $produit)
                            <tr>
                                <td>{{ $produit->id }}</td>
                                <td>
                                    <a href="{{ route('produits.show', $produit->id) }}" class="text-primary">
                                        {{ $produit->nom }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($produit->categories as $categorie)
                                        <span class="badge bg-secondary me-1">{{ $categorie->nom }}</span>
                                    @endforeach
                                </td>
                                <td>{{ number_format($produit->prix_unitaire, 2) }} €</td>
                                <td>
                                    <span class="badge @if($produit->stock > 10) bg-success @elseif($produit->stock > 0) bg-warning text-dark @else bg-danger @endif">
                                        {{ $produit->stock }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('produits.show', $produit->id) }}"
                                           class="btn btn-sm btn-info mx-1" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit->id) }}"
                                           class="btn btn-sm btn-warning mx-1" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST"
                                              class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mx-1" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Aucun produit trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($produits->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Affichage <span class="fw-bold">{{ $produits->firstItem() }}</span>
                    à <span class="fw-bold">{{ $produits->lastItem() }}</span>
                    sur <span class="fw-bold">{{ $produits->total() }}</span> produits
                </div>

                <div>
                    {{ $produits->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
