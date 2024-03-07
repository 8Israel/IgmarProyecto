<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('misiones_completadas', function (Blueprint $table) {
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->foreignId('mision_id')->constrained('misiones');
            $table->timestamp('fecha_completado')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('misiones_completadas');
    }
};
