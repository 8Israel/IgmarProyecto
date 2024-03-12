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
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->foreignId('armas_id')->constrained('armas');
            $table->foreignId('heroes_id')->constrained('heroes');
            $table->integer('cantidad');
=======
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('armas_id')->references('id')->on('armas');
            $table->foreignId('heroes_id')->references('id')->on('heroes');
>>>>>>> 4cc093896bd20414e627f01213ec9c50aad3a990
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios_jugador');
    }
};
