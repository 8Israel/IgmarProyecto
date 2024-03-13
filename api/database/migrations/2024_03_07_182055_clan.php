<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clan', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('nivel_clan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clan');
    }
};
