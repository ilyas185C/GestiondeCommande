@extends('layouts.master')

@section('title', 'Créer une Commande')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus-circle fa-fw me-2"></i>Créer une Commande
        </h1>
        <a href="{{ route('commandes.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="client_id" class="form-label">Client</label>
                        <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                            <option value="">Sélectionner un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date_commande" class="form-label">Date de commande</label>
                        <input type="date" class="form-control @error('date_commande') is-invalid @enderror" 
                               id="date_commande" name="date_commande" value="{{ old('date_commande', date('Y-m-d')) }}" required>
                        @error('date_commande')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="etat_commande" class="form-label">État de la commande</label>
                        <select class="form-select @error('etat_commande') is-invalid @enderror" id="etat_commande" name="etat_commande" required>
                            <option value="en cours" {{ old('etat_commande') == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminée" {{ old('etat_commande') == 'terminée' ? 'selected' : '' }}>Terminée</option>
                            <option value="annulée" {{ old('etat_commande') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                        </select>
                        @error('etat_commande')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection