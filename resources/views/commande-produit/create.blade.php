@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Ajouter un Produit à une Commande</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('commande-produit.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="commande_id">Commande</label>
            <select name="commande_id" id="commande_id" class="form-control" required>
                <option value="">Sélectionner une commande</option>
                @foreach($commandes as $commande)
                    <option value="{{ $commande->id }}">{{ $commande->id }} - {{ $commande->client->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="produit_id">Produit</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="">Sélectionner un produit</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" data-stock="{{ $produit->stock }}">{{ $produit->nom }} (Stock: {{ $produit->stock }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" min="1" required>
            <small id="stockInfo" class="form-text text-muted"></small>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('commande-produit.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script>
    document.getElementById('produit_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        document.getElementById('stockInfo').textContent = `Stock disponible: ${stock}`;
        document.getElementById('quantite').max = stock;
    });
</script>
@endsection