<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amigo;

class AmigosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amigo::create([
            'jugador_id' => 1,
            'nombre_amigo' => 'Amigo 1',
        ]);

        Amigo::create([
            'jugador_id' => 2,
            'nombre_amigo' => 'Amigo 2',
        ]);
    }
}
