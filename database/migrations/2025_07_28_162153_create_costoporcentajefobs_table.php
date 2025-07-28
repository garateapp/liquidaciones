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
        Schema::create('costoporcentajefobs', function (Blueprint $table) {
            $table->id();
                $table->foreignId('temporada_id')->nullable()->constrained()->onDelete('cascade');
                $table->foreignId('costo_id')->nullable()->constrained()->onDelete('cascade');
                $table->decimal('porcentaje', 10, 4)->nullable(); // Porcentaje sobre el FOB
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costoporcentajefobs');
    }
};
