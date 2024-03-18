<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Heroe;
use App\Models\User;
use App\Models\Arma;
use App\Models\Role;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Role;
        $admin->name = "admin";
        $admin->save();

        $user = new Role;
        $user->name = "user";
        $user->save();

        $guest = new Role;
        $guest->name = "guest";
        $guest->save();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'israeldelarosa753@gmail.com';
        $user->password = bcrypt('12345678');
        $user->activate = true;
        $user->role_id = $admin->id;
        $user->codigoVerificado = true;
        $user->save();

        $heroe = new Heroe();
        $heroe->nombre = 'Goku';
        $heroe->tipo = 'Mono';
        $heroe->rareza = 'Normal';
        $heroe->habilidad_especial = 'volar';
        $heroe->save();

        $arma = new Arma;
        $arma->nombre = 'Mp5';
        $arma->tipo = 'smg';
        $arma->rareza = 'normal';
        $arma->danio_base = 20;
        $arma->save();
    }
}
