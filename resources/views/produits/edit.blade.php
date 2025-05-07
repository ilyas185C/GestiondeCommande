@extends('layouts.master')

@section('title', 'Modifier le Produit')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-box fa-fw me-2"></i>Modifier le Produit
        </h1>
        <div>
            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info me-2">
                <i class="fas fa-eye fa-sm text-white-50 me-1"></i> Voir
            </a>
            <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulaire de modification</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="categories" class="form-label">Catégories <span class="text-danger">*</span></label>
                        <select class="form-select select2-multiple @error('categories') is-invalid @enderror"
                                id="categories"
                                name="categories[]"
                                multiple="multiple"
                                required>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ in_array($categorie->id, old('categories', $produit->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="prix_unitaire" class="form-label">Prix unitaire (€) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('prix_unitaire') is-invalid @enderror" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire', $produit->prix_unitaire) }}" required>
                        @error('prix_unitaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $produit->stock) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $produit->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="fas fa-eraser me-1"></i> Réinitialiser
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "Sélectionnez une ou plusieurs catégories",
            allowClear: true
        });
    });
</script>
@endsection
