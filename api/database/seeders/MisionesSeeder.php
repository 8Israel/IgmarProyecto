<?php

namespace Database\Seeders;

use App\Models\Recompensa;
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
        // Recompensas Seeder
        $re1 = new Recompensa();
        $re1->tipo = "nivel 1";
        $re1->xp = 5;
        $re1->save();

        $re2 = new Recompensa();
        $re2->tipo = "nivel 2";
        $re2->xp = 10;
        $re2->save();

        $re3 = new Recompensa();
        $re3->tipo = "nivel 3";
        $re3->xp = 15;
            $re3->save();

        $re4 = new Recompensa();
        $re4->tipo = "nivel 4";
        $re4->xp = 20;
        $re4->save();

        //  Misiones seeder
        $mision1 = new Mision();
        $mision1->nombre = "mision 1";
        $mision1->tipo = "facil";
        $mision1->recompensas_id = $re1->id;
        $mision1->save();

        $mision2 = new Mision();
        $mision2->nombre = "mision 2";
        $mision2->tipo = "facil";
        $mision2->recompensas_id = $re1->id;
        $mision2->save();

        $mision3 = new Mision();
        $mision3->nombre = "mision 3";
        $mision3->tipo = "Media";
        $mision3->recompensas_id = $re2->id;
        $mision3->save();

        $mision4 = new Mision();
        $mision4->nombre = "mision 4";
        $mision4->tipo = "Media";
        $mision4->recompensas_id = $re2->id;
        $mision4->save();

        $mision5 = new Mision();
        $mision5->nombre = "mision 5";
        $mision5->tipo = "Dificil";
        $mision5->recompensas_id = $re3->id;
        $mision5->save();

        $mision6 = new Mision();
        $mision6->nombre = "mision 6";
        $mision6->tipo = "UltraDificil";
        $mision6->recompensas_id = $re4->id;
        $mision6->save();
    }
}
