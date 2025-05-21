<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 py-10">

    <div class="w-full max-w-2xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Créer un compte</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <!-- Nom complet -->
            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nom complet</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required />
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Adresse email</label>
                <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}" required />
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block font-semibold mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required />
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required />
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="telephone" class="block font-semibold mb-1">Téléphone</label>
                <input type="text" name="telephone" id="telephone" class="w-full border rounded px-3 py-2" value="{{ old('telephone') }}" required />
                @error('telephone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label for="adresse" class="block font-semibold mb-1">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="w-full border rounded px-3 py-2" value="{{ old('adresse') }}" required />
                @error('adresse') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>

</body>
</html>
