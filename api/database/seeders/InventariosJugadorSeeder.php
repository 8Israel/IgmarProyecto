<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventarioJugador;

class InventariosJugadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventarioJugador::create([
            'jugador_id' => 1,
            'armas_id' => 1,
            'heroes_id' => 1,
            'cantidad' => 3,
        ]);

        // InventarioJugador::create([
        //     'jugador_id' => 2,
        //     'armas_id' => 2,
        //     'heroes_id' => 2,
        //     'cantidad' => 2,
        // ]);
    }
}
