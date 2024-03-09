<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Arma;

class ArmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arma::create([
            'nombre' => 'Espada de Acero',
            'tipo' => 'Espada',
            'rareza' => 'Común',
            'danio_base' => 10,
            'nivel_requerido' => 1,
        ]);

        Arma::create([
            'nombre' => 'Arco Élfico',
            'tipo' => 'Arco',
            'rareza' => 'Épico',
            'danio_base' => 15,
            'nivel_requerido' => 5,
        ]);
    }
}
