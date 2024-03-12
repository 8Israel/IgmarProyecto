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
        ]);

<<<<<<< HEAD
        // InventarioJugador::create([
        //     'jugador_id' => 2,
        //     'armas_id' => 2,
        //     'heroes_id' => 2,
        //     'cantidad' => 2,
        // ]);
=======
        InventarioJugador::create([
            'jugador_id' => 2,
            'armas_id' => 2,
            'heroes_id' => 2,
        ]);
>>>>>>> 5eeee9b9a5d8dae24b332bfedaf088ca8c82f641
    }
}
