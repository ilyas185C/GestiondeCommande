<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandeFactory extends Factory
{
    protected $model = Commande::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'date_commande' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'etat_commande' => $this->faker->randomElement(['en cours', 'terminée', 'annulée']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
