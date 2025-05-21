<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'enregistrement
     */
    public function showRegistrationForm()
    {
        return view('login.register');
    }

    /**
     * Gère l'enregistrement d'un nouvel utilisateur
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'telephone' => 'required',    // Ajouté
            'adresse' => 'required',      // Ajouté
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client', // par défaut
        ]);

        Client::create([
            'user_id' => $user->id,
            'nom' => $user->name,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'email' => $user->email,   // ajoute cette ligne
        ]);


        return redirect('/login')->with('success', 'Inscription réussie. Connectez-vous.');
    }
}
