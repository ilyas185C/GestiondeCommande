@extends('layouts.master')

@section('title', 'Gestion des Clients')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users fa-fw me-2"></i>Gestion des Clients
        </h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle fa-sm text-white-50 me-1"></i> Nouveau Client
        </a>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des clients</h6>
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
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>
                                    <a href="{{ route('clients.show', $client->id) }}" class="text-primary">
                                        {{ $client->nom }}
                                    </a>
                                </td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ $client->adresse }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('clients.show', $client->id) }}"
                                           class="btn btn-sm btn-info mx-1" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                           class="btn btn-sm btn-warning mx-1" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                              class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">
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
                                <td colspan="6" class="text-center text-muted py-4">Aucun client trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($clients->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $clients->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </ul>
                </nav>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
