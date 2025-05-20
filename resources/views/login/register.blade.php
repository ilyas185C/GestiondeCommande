<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10">

    <div class="w-full max-w-2xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Créer un compte</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nom complet</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Adresse email</label>
                <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}" required>
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block font-semibold mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="phone" class="block font-semibold mb-1">Téléphone</label>
                <input type="text" name="phone" id="phone" class="w-full border rounded px-3 py-2" value="{{ old('phone') }}">
            </div>

            <!-- Adresse (ligne 1) -->
            <div class="mb-4">
                <label for="address_line1" class="block font-semibold mb-1">Adresse (ligne 1)</label>
                <input type="text" name="address_line1" id="address_line1" class="w-full border rounded px-3 py-2" value="{{ old('address_line1') }}">
            </div>

            <!-- Ville -->
            <div class="mb-4">
                <label for="city" class="block font-semibold mb-1">Ville</label>
                <input type="text" name="city" id="city" class="w-full border rounded px-3 py-2" value="{{ old('city') }}">
            </div>

            <!-- Pays -->
            <div class="mb-4">
                <label for="country" class="block font-semibold mb-1">Pays</label>
                <input type="text" name="country" id="country" class="w-full border rounded px-3 py-2" value="{{ old('country') }}">
            </div>

            <!-- Profession -->
            <div class="mb-4">
                <label for="profession" class="block font-semibold mb-1">Profession</label>
                <input type="text" name="profession" id="profession" class="w-full border rounded px-3 py-2" value="{{ old('profession') }}">
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="gender" class="block font-semibold mb-1">Genre</label>
                <select name="gender" id="gender" class="w-full border rounded px-3 py-2">
                    <option value="">-- Sélectionner --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label for="birth_date" class="block font-semibold mb-1">Date de naissance</label>
                <input type="date" name="birth_date" id="birth_date" class="w-full border rounded px-3 py-2" value="{{ old('birth_date') }}">
            </div>

            <!-- Bouton -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>

</body>
</html>
