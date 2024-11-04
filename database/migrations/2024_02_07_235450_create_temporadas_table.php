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
        Schema::create('temporadas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null');

            $table->foreignId('especie_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null');

            $table->integer('status')->default(1);

            $table->string('name');
            $table->string('costos_packing')->nullable();
            $table->string('materiales')->nullable();
            $table->string('gastos_de_exportacion')->nullable();
            $table->string('fletes')->nullable();
            $table->string('comision')->nullable();
            $table->string('balance_de_masa')->nullable();
            $table->string('finanzas')->nullable();
            
            $table->string('seguro')->nullable();
            $table->string('asoex_cc')->nullable();
            $table->string('flete_a_huerto')->nullable();
            $table->string('control_calidad_destino')->nullable();
            $table->string('hidrocooler')->nullable();
            $table->string('variedadroja')->nullable();
            $table->string('variedadbicolor')->nullable();

            $table->date('recepcion_start')->nullable();
            $table->date('recepcion_end')->nullable();

         
            $table->string('exportadora_id')->nullable();

            $table->string('tc')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporadas');
    }
};
