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
>>>>>>> 45f4548c779ea3f9148ae3017d43a31caa16ea14
    }
}