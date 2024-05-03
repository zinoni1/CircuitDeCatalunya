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
        Schema::create('averias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Incidencia');
            $table->string('descripcion');
            $table->date('data_inicio');
            $table->date('data_fin');
            $table->enum('prioridad', ['baja', 'media', 'alta']);
            $table->string('imagen');
            $table->foreignId('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('tecnico_asignado_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('asignador')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('zona_id')->references('id')->on('zonas')->onDelete('cascade');
            $table->foreignId('tipo_averias_id')->references('id')->on('tipo_averias')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('averias');
    }
};
