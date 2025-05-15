<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'description' => $this->faker->optional(0.8)->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
