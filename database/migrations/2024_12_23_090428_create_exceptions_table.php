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
        Schema::create('exceptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
            ->constrained()
            ->onDelete('cascade');
        
            $table->string('entidad')->nullable();
            $table->string('columna')->nullable();
            $table->string('item')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exceptions');
    }
};
