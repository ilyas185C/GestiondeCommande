<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Électronique',
                'description' => 'Produits électroniques et gadgets',
            ],
            [
                'nom' => 'Vêtements',
                'description' => 'Habits et accessoires',
            ],
            [
                'nom' => 'Alimentation',
                'description' => 'Produits alimentaires',
            ],
            [
                'nom' => 'Maison',
                'description' => 'Articles pour la maison',
            ],
            [
                'nom' => 'Sports',
                'description' => 'Équipements et vêtements de sport',
            ],
        ];

        foreach ($categories as $category) {
            Categorie::create($category);
        }

        // Create additional random categories
        Categorie::factory(5)->create();
    }
}
