<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClanMiembro;

class ClanMiembrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClanMiembro::create([
            'clan_id' => 1,
            'jugador_id' => 1,
            'rango' => 'Líder',
        ]);

        ClanMiembro::create([
            'clan_id' => 1,
            'jugador_id' => 2,
            'rango' => 'Oficial',
        ]);
    }
}
