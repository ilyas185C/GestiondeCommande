@extends('layouts.master')

@section('title', 'Gestion des Commandes')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-shopping-cart fa-fw me-2"></i>Gestion des Commandes
        </h1>
        <a href="{{ route('commandes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle fa-sm text-white-50 me-1"></i> Nouvelle Commande
        </a>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des commandes</h6>
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
                            <th>Client</th>
                            <th>Date</th>
                            <th>État</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>
                                    <a href="{{ route('clients.show', $commande->client->id) }}" class="text-primary">
                                        {{ $commande->client->nom }}
                                    </a>
                                </td>
                                <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge
                                        @if($commande->etat_commande == 'terminée') bg-success
                                        @elseif($commande->etat_commande == 'en cours') bg-warning text-dark
                                        @else bg-danger @endif">
                                        {{ ucfirst($commande->etat_commande) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('commandes.show', $commande->id) }}"
                                           class="btn btn-sm btn-info mx-1" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('commandes.edit', $commande->id) }}"
                                           class="btn btn-sm btn-warning mx-1" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST"
                                              class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande?')">
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
                                <td colspan="6" class="text-center text-muted py-4">Aucune commande trouvée</td>
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
