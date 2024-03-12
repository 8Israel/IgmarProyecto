<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; 

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
         Role::create(['name' => 'admin']);
         Role::create(['name' => 'user']);
         Role::create(['name' => 'guest']);
=======
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'guest']);
>>>>>>> 29479a3aeb28df7ffd6472111937f08369130abc
    }
}