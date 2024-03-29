<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('estadisticas', function (Blueprint $table) {
        $table->id();
        $table->integer('nivel')->nullable();
        $table->integer('experiencia')->nullable();
        $table->integer('puntuacion')->nullable();
        $table->foreignId('user_id')->nullable()->references('id')->on('users');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadisticas');
    }
};
