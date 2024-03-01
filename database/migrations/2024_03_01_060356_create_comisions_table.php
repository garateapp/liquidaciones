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
        Schema::create('comisions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade');

            $table->string('productor')->nullable();
            $table->string('comision')->nullable();
            $table->string('flete_huerto')->nullable();
            $table->string('minimo_garantizado')->nullable();
            $table->string('rebate')->nullable();
            $table->string('tarifa_premium')->nullable();
            $table->string('comparativa')->nullable();
            $table->string('descuento_fruta_comercial')->nullable();
            $table->string('cumplimiento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comisions');
    }
};
