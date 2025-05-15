<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 random products
        $produits = Produit::factory(50)->create();

        // Assign random categories to each product
        $categories = Categorie::all();

        foreach ($produits as $produit) {
            // Attach 1 to 3 random categories to each product
            $categoriesForProduct = $categories->random(rand(1, 3))->pluck('id')->toArray();
            $produit->categories()->attach($categoriesForProduct);
        }
    }
}
