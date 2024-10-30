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
        Schema::create('factorbalances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->string('id_empresa'); // ID de la empresa
            $table->string('numero_guia_produccion')->nullable(); // Número de guía de producción
            $table->string('c_productor')->nullable(); // Código del productor
            $table->string('c_etiqueta')->nullable(); // Código de etiqueta
            $table->string('id_variedad')->nullable(); // ID de la variedad
            $table->string('c_calibre')->nullable(); // Código del calibre
            $table->string('c_categoria')->nullable(); // Código de la categoría
            $table->string('c_embalaje')->nullable(); // Código del embalaje

            // Agregar columnas de total y total_proceso como strings
            $table->string('total')->nullable(); // Total como string
            $table->string('total_proceso')->nullable(); // Total del proceso como string

            $table->string('factor')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factorbalances');
    }
};
