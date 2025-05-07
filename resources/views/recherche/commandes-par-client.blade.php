@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Commandes par client</h2>
    
    <form action="{{ route('recherche.commandes-par-client') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <select name="client_id" class="form-select" required onchange="this.form.submit()">
                    <option value="">Tous les clients</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }} {{ $client->prenom }} ({{ $client->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                @if(request('client_id'))
                    <a href="{{ route('recherche.commandes-par-client') }}" class="btn btn-secondary">Réinitialiser</a>
                @endif
            </div>
        </div>
    </form>

    @if(request('client_id') && $commandes->isEmpty())
        <div class="alert alert-info">
            Aucune commande trouvée pour ce client.
        </div>
    @elseif($commandes->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>État</th>
                        <th>Produits</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                            <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                            <td>
                                <span class="badge bg-{{ $commande->etat_commande == 'terminée' ? 'success' : ($commande->etat_commande == 'annulée' ? 'danger' : 'warning') }}">
                                    {{ $commande->etat_commande }}
                                </span>
                            </td>
                            <td>
                                <ul>
                                    @foreach($commande->produits as $produit)
                                        <li>{{ $produit->nom }} (x{{ $produit->pivot->quantite }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ number_format($commande->montant_total, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Sélectionnez un client pour voir ses commandes.
        </div>
    @endif
</div>
@endsection