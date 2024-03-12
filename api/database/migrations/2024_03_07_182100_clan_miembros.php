<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clan_miembros', function (Blueprint $table) {
            $table->foreignId('clan_id')->references('id')->on('clan');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->string('rango');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clan_miembros');
    }
};
