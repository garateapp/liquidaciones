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
        Schema::table('temporadas', function (Blueprint $table) {
            $table->string('seguro');
            $table->string('asoex_cc')->nullable();
            $table->string('flete_a_huerto')->nullable();
            $table->string('control_calidad_destino')->nullable();
            $table->string('hidrocooler')->nullable();
            $table->string('variedadroja')->nullable();
            $table->string('variedadbicolor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temporadas', function (Blueprint $table) {
            //
        });
    }
};
