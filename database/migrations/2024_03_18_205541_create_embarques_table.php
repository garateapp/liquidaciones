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
        Schema::create('embarques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            
            $table->string('n_embarque')->nullable();
            $table->string('fecha_embarque')->nullable();
            $table->string('nave')->nullable();
            $table->string('transporte')->nullable();
            $table->string('fecha_despacho')->nullable();
            $table->string('numero_g_despacho')->nullable();
            $table->string('numero_guia_produccion')->nullable();
            $table->string('etd')->nullable(); // Estimated Time of Departure
            $table->string('eta')->nullable(); // Estimated Time of Arrival

            $table->string('duplicado')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embarques');
    }
};
