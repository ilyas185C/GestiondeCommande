<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categories')->latest()->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $produit = Produit::create($request->except('categories'));
        $produit->categories()->sync($request->categories);

        return redirect()->route('produits.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function show(Produit $produit)
    {
        $produit->load('categories');
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $produit->update($request->except('categories'));
        $produit->categories()->sync($request->categories);

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->categories()->detach();
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
