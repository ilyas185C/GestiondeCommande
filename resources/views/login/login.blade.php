<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Espace Professionnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --light-color: #f8fafc;
            --dark-color: #0f172a;
            --border-color: #e2e8f0;
            --text-muted: #64748b;
        }

        body {
            background-color: #f1f5f9;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background-color: white;
        }

        .card-header {
            background-color: white;
            border-bottom: none;
            padding: 2rem 2rem 0.5rem;
            text-align: center;
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: var(--light-color);
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background-color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        .forgot-password {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .divider-text {
            padding: 0 1rem;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .social-btn {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-color);
            color: var(--dark-color);
            font-size: 1.2rem;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .signup-text {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .signup-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            z-index: 10;
        }

        .has-icon {
            padding-left: 2.75rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            z-index: 10;
            background: none;
            border: none;
            cursor: pointer;
        }

        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            padding: 1rem;
        }

        .remember-me {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container login-container animate__animated animate__fadeIn">
        <div class="login-card card">
            <div class="card-header">
                <div class="logo-container">
                    <svg class="logo" viewBox="0 0 100 30">
                        <rect x="10" y="8" width="20" height="20" fill="#2563eb" rx="4" />
                        <rect x="40" y="8" width="20" height="20" fill="#3b82f6" rx="4" />
                        <rect x="70" y="8" width="20" height="20" fill="#60a5fa" rx="4" />
                    </svg>
                </div>
                <h1 class="header-title">Bienvenue</h1>
                <p class="header-subtitle">Connectez-vous à votre espace professionnel</p>
            </div>
            <div class="card-body">
                <div class="alert alert-danger animate__animated animate__shakeX" style="display: none;">
                    Les identifiants sont incorrects. Veuillez réessayer.
                </div>

                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <div class="input-group">
                            <i class="input-icon far fa-envelope"></i>
                            <input type="email" class="form-control has-icon" id="email" name="email" required
                                autofocus placeholder="nom@entreprise.com">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label">Mot de passe</label>
                            <a href="{{ route('password.request') }}" class="forgot-password">Oublié?</a>
                        </div>
                        <div class="input-group">
                            <i class="input-icon fas fa-lock"></i>
                            <input type="password" class="form-control has-icon" id="password" name="password" required
                                placeholder="••••••••">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label remember-me" for="remember">
                                Rester connecté
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Se connecter
                        </button>
                    </div>
                    <div class="signup-text">
                        Vous n’avez pas de compte ?
                        <a href="{{ route('register') }}">Créer un compte</a>
                    </div>

                    <div class="divider">
                        <span class="divider-text">ou continuer avec</span>
                    </div>

                    <div class="social-login">
                        <a href="#" class="social-btn">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-microsoft"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-apple"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>

                    <div class="signup-text">
                        Vous n’avez pas de compte ?
                        <a href="{{ route('register') }}">Créer un compte</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
