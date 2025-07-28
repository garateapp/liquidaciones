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
        Schema::create('costo_categorias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('costo_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('costo_por_kg', 20, 15)->nullable();
            $table->decimal('total_kgs', 20, 4)->nullable();
            $table->decimal('monto_total', 20, 4)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costo_categorias');
    }
};
