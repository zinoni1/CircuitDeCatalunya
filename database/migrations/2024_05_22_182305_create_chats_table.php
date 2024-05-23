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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('missatge');
            $table->dateTime('data_missatge')->nullable();
            $table->foreignId('id_enviat')->references('id')->on('users');
            $table->foreignId('id_rebut')->references('id')->on('users');
            $table->unsignedBigInteger('id_grupo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
