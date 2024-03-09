<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clan;

class ClanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clan::create([
            'nombre' => 'Clan de los Valientes',
            'lider_id' => 1,
            'nivel_clan' => 5,
        ]);

    }
}
