@extends('layouts.master')

@section('title', 'Montant par Période & État')
@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0">
                        <i class="fas fa-filter me-2"></i>Filtres de recherche
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('recherche.montant-par-periode') }}" method="GET">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="annee" class="form-label">Année</label>
                                <select class="form-select" id="annee" name="annee" required>
                                    <option value="">-- Sélectionnez une année --</option>
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee }}" {{ request('annee') == $annee ? 'selected' : '' }}>
                                            {{ $annee }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="mois" class="form-label">Mois</label>
                                <select class="form-select" id="mois" name="mois" required>
                                    <option value="">-- Sélectionnez un mois --</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('mois') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="etat_commande" class="form-label">État</label>
                                <select class="form-select" id="etat_commande" name="etat_commande" required>
                                    <option value="">-- Sélectionnez un état --</option>
                                    @foreach($etats as $etat)
                                        <option value="{{ $etat }}" {{ request('etat_commande') == $etat ? 'selected' : '' }}>
                                            {{ ucfirst($etat) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i> Rechercher
                                </button>
                                @if(request()->anyFilled(['annee', 'mois', 'etat_commande']))
                                    <a href="{{ route('recherche.montant-par-periode') }}" class="btn btn-secondary">
                                        <i class="fas fa-undo me-2"></i> Réinitialiser
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($commandes))
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Résultats de la recherche</h4>
                    <div class="d-flex gap-3">
                        <span class="badge bg-primary">
                            {{ $commandes->count() }} commande(s)
                        </span>
                        <span class="badge bg-success">
                            Total: {{ number_format($montantTotal, 2, ',', ' ') }} €
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($commandes->isEmpty())
                        <div class="alert alert-info">
                            Aucune commande trouvée pour les critères sélectionnés.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>N° Commande</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>État</th>
                                        <th>Produits</th>
                                        <th class="text-end">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commandes as $commande)
                                    <tr>
                                        <td>CMD-{{ str_pad($commande->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            {{ $commande->client->nom }} {{ $commande->client->prenom }}
                                            <br>
                                            <small class="text-muted">{{ $commande->client->email }}</small>
                                        </td>
                                        <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $commande->etat_commande == 'terminée' ? 'success' : ($commande->etat_commande == 'annulée' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($commande->etat_commande) }}
                                            </span>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($commande->produits as $produit)
                                                    <li>
                                                        <span class="badge bg-light text-dark">{{ $produit->pivot->quantite }}x</span>
                                                        {{ $produit->nom }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-end">{{ number_format($commande->montant_total, 2, ',', ' ') }} €</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection