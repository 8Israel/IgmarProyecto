<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recompensa;

class RecompensasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recompensa::create([
            'tipo' => 'Moneda',
            'descripcion' => 'Oro',
            'valor' => 100,
        ]);

        Recompensa::create([
            'tipo' => 'Objeto',
            'descripcion' => 'Piedra Preciosa',
            'valor' => 50,
        ]); 
    }
}
