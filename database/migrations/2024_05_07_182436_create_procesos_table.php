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
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->string('tipo_g_produccion')->nullable();
            $table->string('numero_g_produccion')->nullable();
            $table->string('fecha_g_produccion')->nullable();
            $table->string('fecha_produccion')->nullable();
            $table->string('tipo')->nullable();
            $table->string('id_productor_proceso')->nullable();
            $table->string('n_productor_proceso')->nullable();
            $table->string('c_productor')->nullable();
            $table->string('n_productor')->nullable();
            $table->string('t_categoria')->nullable();
            $table->string('c_categoria')->nullable();
            $table->string('c_embalaje')->nullable();
            $table->string('c_calibre')->nullable();
            $table->string('c_serie')->nullable();
            $table->string('c_etiqueta')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('peso_neto')->nullable();
            $table->string('id_empresa')->nullable();
            $table->string('fecha_recepcion')->nullable();
            $table->string('folio')->nullable();
            $table->string('id_exportadora')->nullable();
            $table->string('id_especie')->nullable();
            $table->string('id_variedad')->nullable();
            $table->string('id_linea_proceso')->nullable();
            $table->string('numero_guia_recepcion')->nullable();
            $table->string('id_embalaje')->nullable();
            $table->string('n_tipo_proceso')->nullable();
            $table->string('n_variedad_rotulacion')->nullable();
            $table->string('peso_std_embalaje')->nullable();
            $table->string('peso_standard')->nullable();
            $table->string('creacion_tipo')->nullable();
            $table->string('notas')->nullable(); // Usamos 'text' en lugar de 'string' para notas más largas
            $table->string('Estado')->nullable();
            $table->string('destruccion_tipo')->nullable();

            $table->string('duplicado')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
