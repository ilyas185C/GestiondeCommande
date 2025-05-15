@extends('layouts.master')

@section('title', 'Statistiques par Produit')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="fas fa-chart-bar me-2"></i>Statistiques par Produit
            </h3>
            @if($statistiques->isNotEmpty())
                <a href="{{ route('recherche.telecharger') }}" class="btn btn-success">
                    <i class="fas fa-download me-1"></i> Télécharger
                </a>
            @endif
        </div>
        <div class="card-body">
            @if($statistiques->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="40%">Produit</th>
                                <th width="15%" class="text-end">Prix Unitaire</th>
                                <th width="15%" class="text-center">Quantité Vendue</th>
                                <th width="30%" class="text-end">Chiffre d'Affaires</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statistiques as $stat)
                                <tr>
                                    <td>
                                        <strong>{{ $stat->nom }}</strong>
                                        @if($stat->quantite_totale > 0)
                                            <div class="progress mt-2" style="height: 5px;">
                                                <div class="progress-bar bg-success"
                                                     role="progressbar"
                                                     style="width: {{ ($stat->chiffre_affaires / $statistiques->sum('chiffre_affaires')) * 100 }}%"
                                                     aria-valuenow="{{ $stat->chiffre_affaires }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="{{ $statistiques->sum('chiffre_affaires') }}">
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($stat->prix_unitaire, 2, ',', ' ') }} €</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $stat->quantite_totale }}</span>
                                    </td>
                                    <td class="text-end">
                                        <strong>{{ number_format($stat->chiffre_affaires, 2, ',', ' ') }} €</strong>
                                        <small class="text-muted d-block">
                                            ({{ round(($stat->chiffre_affaires / $statistiques->sum('chiffre_affaires')) * 100, 1) }}%)
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <th colspan="3" class="text-end">Total Général:</th>
                                <th class="text-end text-success">
                                    {{ number_format($statistiques->sum('chiffre_affaires'), 2, ',', ' ') }} €
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Aucune statistique disponible pour le moment</h4>
                    <p class="mb-0">Les données statistiques apparaîtront ici lorsqu'il y aura des ventes enregistrées.</p>
                </div>
            @endif
        </div>
        @if($statistiques->isNotEmpty())
            <div class="card-footer bg-white">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Statistiques calculées à partir des commandes validées (exclut les commandes annulées)
                </small>
            </div>
        @endif
    </div>
</div>
@endsection