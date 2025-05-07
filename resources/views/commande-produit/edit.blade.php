@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Modifier la Quantité du Produit dans la Commande</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('commande-produit.update', [$commande->id, $produit->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Commande</label>
            <input type="text" class="form-control" value="Commande #{{ $commande->id }} - {{ $commande->client->nom }}" readonly>
        </div>
        
        <div class="form-group">
            <label>Produit</label>
            <input type="text" class="form-control" value="{{ $produit->nom }} (Stock: {{ $produit->stock }})" readonly>
        </div>
        
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" 
                   min="1" max="{{ $produit->stock + $pivot->quantite }}" 
                   value="{{ $pivot->quantite }}" required>
            <small class="form-text text-muted">
                Stock disponible: {{ $produit->stock }} (vous pouvez augmenter jusqu'à {{ $produit->stock + $pivot->quantite }})
            </small>
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('commande-produit.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection