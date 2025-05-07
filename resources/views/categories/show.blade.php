@extends('layouts.master')

@section('title', 'Détails de la Catégorie')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-tag fa-fw me-2"></i>Détails de la Catégorie
        </h1>
        <div>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Modifier
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de la catégorie</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">ID:</div>
                        <div class="col-sm-9">{{ $category->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nom:</div>
                        <div class="col-sm-9">{{ $category->nom }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Description:</div>
                        <div class="col-sm-9">{{ $category->description ?? 'Aucune description' }}</div>
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
                        <div class="text-muted small">Produits associés</div>
                        <div class="h2 font-weight-bold text-primary">{{ $category->produits_count ?? 0 }}</div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small">Dernier produit ajouté</div>
                        <div class="h5 font-weight-bold">
                            @if($category->produits->count() > 0)
                                {{ $category->produits->last()->nom }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection