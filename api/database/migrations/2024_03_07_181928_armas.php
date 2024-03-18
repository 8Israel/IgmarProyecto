<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('armas');
        Schema::create('armas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('rareza');
            $table->integer('danio_base');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('armas');
    }
};
