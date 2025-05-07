@extends('layouts.master')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-tags fa-fw me-2"></i>Gestion des Catégories
        </h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle fa-sm text-white-50 me-1"></i> Nouvelle Catégorie
        </a>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des catégories</h6>
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
                            <th>Description</th>
                            <th>Nombre de Produits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}" class="text-primary">
                                        {{ $category->nom }}
                                    </a>
                                </td>
                                <td>{{ Str::limit($category->description, 50) ?: 'Aucune description' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $category->produits_count }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                           class="btn btn-sm btn-info mx-1" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-warning mx-1" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                              class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
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
                                <td colspan="5" class="text-center text-muted py-4">Aucune catégorie trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $categories->onEachSide(1)->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
