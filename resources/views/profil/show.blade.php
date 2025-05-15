@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"><i class="fas fa-user-circle me-2"></i>Profil Utilisateur</h3>
                        <span class="badge bg-white text-primary">
                            <i class="fas fa-calendar-alt me-1"></i> Membre depuis {{ $user->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Colonne Photo de Profil -->
                        <div class="col-md-4 col-lg-3 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <div class="avatar-profile mx-auto mb-3">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                @if($user->is_active)
                                    <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-3 border-white rounded-circle">
                                        <span class="visually-hidden">Compte actif</span>
                                    </span>
                                @endif
                            </div>

                            <h4 class="mb-1">{{ $user->name }}</h4>
                            <p class="text-muted mb-2">
                                <i class="fas fa-envelope me-1"></i> {{ $user->email }}
                            </p>

                            @if($user->phone)
                                <p class="mb-3">
                                    <i class="fas fa-phone-alt me-1"></i>
                                    <a href="tel:{{ $user->phone }}" class="text-decoration-none">{{ $user->phone }}</a>
                                </p>
                            @endif

                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="fas fa-edit me-1"></i> Modifier le profil
                                </button>
                            </div>
                        </div>

                        <!-- Colonne Détails -->
                        <div class="col-md-8 col-lg-9">
                            <!-- Section Informations Personnelles -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Informations Personnelles</h5>
                                    <span class="badge bg-primary">
                                        {{ $user->roles?->first()->name ?? 'Utilisateur Standard' }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <strong><i class="fas fa-user me-2"></i>Nom complet:</strong>
                                                    <span class="float-end">{{ $user->name }}</span>
                                                </li>
                                                @if($user->birth_date)
                                                <li class="mb-3">
                                                    <strong><i class="fas fa-birthday-cake me-2"></i>Date de naissance:</strong>
                                                    <span class="float-end">{{ \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($user->birth_date)->age }} ans)</span>
                                                </li>
                                                @endif
                                                @if($user->gender)
                                                <li class="mb-3">
                                                    <strong><i class="fas fa-venus-mars me-2"></i>Genre:</strong>
                                                    <span class="float-end">{{ ucfirst($user->gender) }}</span>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                @if($user->profession)
                                                <li class="mb-3">
                                                    <strong><i class="fas fa-briefcase me-2"></i>Profession:</strong>
                                                    <span class="float-end">{{ $user->profession }}</span>
                                                </li>
                                                @endif
                                                <li class="mb-3">
                                                    <strong><i class="fas fa-calendar-check me-2"></i>Inscrit depuis:</strong>
                                                    <span class="float-end">{{ $user->created_at->diffForHumans() }}</span>
                                                </li>
                                                <li>
                                                    <strong><i class="fas fa-user-shield me-2"></i>Statut:</strong>
                                                    <span class="float-end badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Adresse -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Adresse</h5>
                                </div>
                                <div class="card-body">
                                    @if($user->address_line1 || $user->city)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-unstyled">
                                                    @if($user->address_line1)
                                                    <li class="mb-2">
                                                        <strong>Adresse:</strong> {{ $user->address_line1 }}
                                                    </li>
                                                    @endif
                                                    @if($user->address_line2)
                                                    <li class="mb-2">
                                                        <strong>Complément:</strong> {{ $user->address_line2 }}
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-unstyled">
                                                    @if($user->street)
                                                    <li class="mb-2">
                                                        <strong>Rue:</strong> {{ $user->street }}
                                                    </li>
                                                    @endif
                                                    <li class="mb-2">
                                                        <strong>Ville:</strong> {{ $user->zip_code }} {{ $user->city }}
                                                    </li>
                                                    @if($user->state)
                                                    <li class="mb-2">
                                                        <strong>Région:</strong> {{ $user->state }}
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <strong>Pays:</strong> {{ $user->country }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if($user->latitude && $user->longitude)
                                        <div class="mt-3" id="miniMap" style="height: 150px; border-radius: 8px;"></div>
                                        @endif
                                    @else
                                        <div class="text-center py-3">
                                            <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucune adresse enregistrée</p>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-plus me-1"></i> Ajouter une adresse
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Section Notes -->
                            @if($user->notes)
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Notes</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light p-3 rounded">
                                        {{ $user->notes }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Retour à l'accueil
                        </a>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger">
                                <i class="fas fa-lock me-2"></i> Changer le mot de passe
                            </button>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'édition -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel">Modifier le profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm">
                    <!-- Formulaire d'édition ici -->
                    <div class="text-center py-4">
                        <p class="text-muted">Fonctionnalité d'édition à implémenter</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-profile {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .avatar-profile:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .card-header {
        font-weight: 600;
        padding: 1rem 1.5rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%) !important;
    }

    .list-unstyled li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .list-unstyled li:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .avatar-profile {
            width: 120px;
            height: 120px;
            font-size: 50px;
        }
    }
</style>
@endsection

@section('scripts')
@if($user->latitude && $user->longitude)
<script>
    // Initialisation d'une mini carte si les coordonnées GPS sont disponibles
    function initMiniMap() {
        const map = L.map('miniMap').setView([{{ $user->latitude }}, {{ $user->longitude }}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $user->latitude }}, {{ $user->longitude }}]).addTo(map)
            .bindPopup('Localisation approximative');
    }

    // Charger la bibliothèque Leaflet JS pour la carte
    function loadLeaflet() {
        const script = document.createElement('script');
        script.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
        script.integrity = 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==';
        script.crossOrigin = '';
        script.onload = initMiniMap;

        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
        link.integrity = 'sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==';
        link.crossOrigin = '';

        document.head.appendChild(link);
        document.head.appendChild(script);
    }

    document.addEventListener('DOMContentLoaded', loadLeaflet);
</script>
@endif
@endsection
