<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventarios_users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD

           

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('armas_id')->references('id')->on('armas');
            $table->foreignId('heroes_id')->references('id')->on('heroes');

=======
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('armas_id')->nullable()->references('id')->on('armas');
            $table->foreignId('heroes_id')->nullable()->references('id')->on('heroes');
>>>>>>> 45f4548c779ea3f9148ae3017d43a31caa16ea14
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios_jugador');
    }
};
