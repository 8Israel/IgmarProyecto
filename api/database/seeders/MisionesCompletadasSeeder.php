<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MisionCompletada;

class MisionesCompletadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MisionCompletada::create([
            'jugador_id' => 1,
            'mision_id' => 1,
            'fecha_completado' => now(),
        ]);

        MisionCompletada::create([
            'jugador_id' => 2,
            'mision_id' => 2,
            'fecha_completado' => now(),
        ]);
    }
}
