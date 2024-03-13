<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('inventarios_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('CASCADE');;
            $table->foreignId('armas_id')->nullable()->references('id')->on('armas')->onDelete('CASCADE');
            $table->foreignId('heroes_id')->nullable()->references('id')->on('heroes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios_users');
    }
};
