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
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->foreignId('armas_id')->constrained('armas');
            $table->foreignId('heroes_id')->constrained('heroes');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios_jugador');
    }
};
