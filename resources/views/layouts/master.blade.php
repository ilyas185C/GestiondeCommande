<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Commande - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --footer-height: 60px;
            --primary-color: #3a7bd5;
            --primary-dark: #2c5fb3;
            --secondary-color: #f8f9fa;
            --text-color: #495057;
            --text-light: #6c757d;
            --border-color: #e9ecef;
        }
        
        body {
            min-height: 100vh;
            color: var(--text-color);
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: var(--header-height);
        }
        
        /* Header Styles */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 25px;
        }
        
        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--header-height);
            bottom: var(--footer-height);
            left: 0;
            overflow-y: auto;
            z-index: 900;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .nav-title {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
            padding: 15px 25px 5px;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .sidebar-link:hover, .sidebar-link.active {
            background-color: rgba(58, 123, 213, 0.1);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }
        
        .sidebar-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Submenu Styles */
        .submenu {
            padding-left: 20px;
        }
        
        .submenu .sidebar-link {
            padding: 10px 25px 10px 45px;
            font-size: 0.95rem;
            border-left: none;
        }
        
        .submenu .sidebar-link i {
            font-size: 0.9rem;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
        }
        
        /* Footer Styles */
        .app-footer {
            position: fixed;
            bottom: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--footer-height);
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 1px solid var(--border-color);
            z-index: 800;
            padding: 0 30px;
        }
        
        .footer-content {
            color: var(--text-light);
            font-size: 0.9rem;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content, .app-footer {
                margin-left: 0;
            }
        }
        
        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <div class="logo">
            <i class="fas fa-box-open"></i>
            <span>Gestion de Commande</span>
        </div>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-menu">
            <!-- Gestion Section -->
            <div class="nav-title">Gestion</div>
            <a href="{{ route('clients.index') }}" class="sidebar-link">
                <i class="fas fa-users"></i>
                Clients
            </a>
            <a href="{{ route('categories.index') }}" class="sidebar-link">
                <i class="fas fa-tags"></i>
                Catégories
            </a>
            <a href="{{ route('produits.index') }}" class="sidebar-link">
                <i class="fas fa-boxes"></i>
                Produits
            </a>
            <a href="{{ route('commandes.index') }}" class="sidebar-link">
                <i class="fas fa-shopping-cart"></i>
                Commandes
            </a>
            <a href="{{ route('commande-produit.index') }}" class="sidebar-link">
                <i class="fas fa-link"></i>
                Affectation Commande-Produit
            </a>

            <!-- Recherche Section -->
            <div class="nav-title">Recherche</div>
            <div class="submenu">
                <a href="{{ route('recherche.commandes-par-client') }}" class="sidebar-link">
                    <i class="fas fa-search"></i>
                    Commandes par Client
                </a>
                <a href="{{ route('recherche.montant-par-periode') }}" class="sidebar-link">
                    <i class="fas fa-chart-line"></i>
                    Montant par Période & État
                </a>
                <a href="{{ route('recherche.statistiques-produit') }}" class="sidebar-link">
                    <i class="fas fa-chart-pie"></i>
                    Statistiques par Produit
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="app-footer">
        <div class="footer-content">
            <div>&copy; {{ date('Y') }} Gestion de Commande - Tous droits réservés</div>
            <div>Version 1.0.0</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle functionality can be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle implementation if needed
        });
    </script>
</body>
</html>