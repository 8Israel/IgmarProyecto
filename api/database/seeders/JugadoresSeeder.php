<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jugador;

class JugadoresSeeder extends Seeder
{
    public function run()
    {
        Jugador::create([
            'nombre' => 'Jugador 1',
            'nivel' => 1,
            'experiencia' => 0,
            'puntuacion' => 0,
            'user_id' => 1
        ]);

        Jugador::create([
            'nombre' => 'Jugador 2',
            'nivel' => 2,
            'experiencia' => 100,
            'puntuacion' => 500,
            'user_id' => 2
        ]);

        
    }
}
