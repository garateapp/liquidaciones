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
        Schema::create('costoembalajecodes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('costo_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->string('c_embalaje')->nullable();
            $table->string('costo_por_caja')->nullable();
            $table->string('costo_por_kg')->nullable();
            $table->string('descripcion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costoembalajecodes');
    }
};
