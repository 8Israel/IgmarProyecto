<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Heroe;

class HeroesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Heroe::create([
            'nombre' => 'Heroe 1',
            'tipo' => 'Guerrero',
            'rareza' => 'Épico',
            'habilidad_especial' => 'Ataque Frenético',
        ]);

        Heroe::create([
            'nombre' => 'Heroe 2',
            'tipo' => 'Mago',
            'rareza' => 'Legendaria',
            'habilidad_especial' => 'Bola de Fuego',
        ]);
    }
}
