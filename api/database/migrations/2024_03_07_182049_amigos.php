<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->string('nombre_amigo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('amigos');
    }
};
