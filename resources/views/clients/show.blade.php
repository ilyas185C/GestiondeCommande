@extends('layouts.master')

@section('title', 'Détails du Client')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user fa-fw me-2"></i>Détails du Client
        </h1>
        <div>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Modifier
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations du client</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">ID:</div>
                        <div class="col-sm-9">{{ $client->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nom:</div>
                        <div class="col-sm-9">{{ $client->nom }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Email:</div>
                        <div class="col-sm-9">{{ $client->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Téléphone:</div>
                        <div class="col-sm-9">{{ $client->telephone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Adresse:</div>
                        <div class="col-sm-9">{{ $client->adresse }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Date création:</div>
                        <div class="col-sm-9">{{ $client->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 font-weight-bold">Dernière modification:</div>
                        <div class="col-sm-9">{{ $client->updated_at->format('d/m/Y H:i') }}</div>
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
                        <div class="h2 font-weight-bold text-primary">0</div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small">Dernière commande</div>
                        <div class="h5 font-weight-bold">-</div>
                    </div>
                    <div>
                        <div class="text-muted small">Montant total</div>
                        <div class="h4 font-weight-bold text-success">0,00 €</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection