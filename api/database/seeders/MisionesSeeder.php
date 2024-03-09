<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mision;

class MisionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mision::create([
            'nombre' => 'Rescate del Prisionero',
            'tipo' => 'Rescate',
            'recompensa_xp' => 500,
            'recompensa_items' => 'Poción de Curación',
        ]);

        Mision::create([
            'nombre' => 'Búsqueda del Tesoro',
            'tipo' => 'Exploración',
            'recompensa_xp' => 1000,
            'recompensa_items' => 'Gemas',
        ]);
    }
}
