<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::dropIfExists('recompensas'); 
        Schema::create('recompensas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->integer('xp');
            $table->timestamps();
        });
        Schema::dropIfExists('misiones'); 
        Schema::create('misiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->foreignId('recompensas_id')->references('id')->on('recompensas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('misiones');
        Schema::dropIfExists('recompensas');
    }
};
