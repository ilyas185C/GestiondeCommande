<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Exemple d'intégration CSS (facultatif) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- En-tête avec nom et bouton de déconnexion -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Bienvenue, {{ Auth::user()->name }}</h1>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
            </form>
        </div>

        <!-- Liste des commandes -->
        <h3 class="h5 mb-3">Vos commandes</h3>
        <ul class="list-group">
            @forelse ($commandes as $commande)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Commande du {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}
                    <span class="badge bg-primary">{{ $commande->etat_commande }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">Aucune commande pour le moment.</li>
            @endforelse
        </ul>
    </div>

</body>
</html>
