<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $clients = Client::all();
        $produits = Produit::all();

        // Create 30 orders
        Commande::factory(30)->create()->each(function ($commande) use ($produits) {
            // Add 1 to 5 random products to each order
            $produitsForOrder = $produits->random(rand(1, 5));

            foreach ($produitsForOrder as $produit) {
                $commande->produits()->attach($produit->id, [
                    'quantite' => rand(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
