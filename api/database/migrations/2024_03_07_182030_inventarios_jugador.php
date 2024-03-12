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
=======

>>>>>>> 29479a3aeb28df7ffd6472111937f08369130abc
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('armas_id')->references('id')->on('armas');
            $table->foreignId('heroes_id')->references('id')->on('heroes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios_jugador');
    }
};
