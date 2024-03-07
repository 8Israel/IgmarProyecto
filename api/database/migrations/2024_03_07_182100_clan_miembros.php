<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clan_miembros', function (Blueprint $table) {
            $table->foreignId('clan_id')->constrained('clan');
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->string('rango'); // por ejemplo, miembro, oficial, líder
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clan_miembros');
    }
};
