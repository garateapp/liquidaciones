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
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            
            $table->string('id_pkg_stock_det')->nullable();
            $table->string('tipo_g_despacho')->nullable();
            $table->string('numero_g_despacho')->nullable();
            $table->string('fecha_g_despacho')->nullable();

            $table->string('fecha_produccion')->nullable();
            $table->string('r_productor')->nullable();
            $table->string('n_variedad')->nullable();
            $table->string('semana')->nullable();
            $table->string('n_categoria')->nullable();
            $table->string('exportacion')->nullable();
            $table->string('exportacion_embarque')->nullable();

            $table->string('id_empresa')->nullable();
            $table->string('id_exportadora')->nullable();
            $table->string('id_exportadora_embarque')->nullable();
            $table->string('c_destinatario')->nullable();
            $table->string('n_destinatario')->nullable();
            $table->string('n_transportista')->nullable();
            $table->string('folio')->nullable();
            $table->string('numero_guia_produccion')->nullable();
            $table->string('c_productor')->nullable();
            $table->string('n_productor')->nullable();
            $table->string('id_especie')->nullable();
            $table->string('id_variedad')->nullable();
            $table->string('id_embalaje')->nullable();
            $table->string('c_embalaje')->nullable();
            $table->string('peso_std_embalaje')->nullable();
            $table->string('c_categoria')->nullable();
            $table->string('t_categoria')->nullable();
            $table->string('c_calibre')->nullable();
            $table->string('n_calibre')->nullable();
            $table->string('c_serie')->nullable();
            $table->string('c_etiqueta')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('peso_neto')->nullable();
            $table->string('n_variedad_rotulacion')->nullable();
            $table->string('N_Pais_Destino')->nullable();
            $table->string('N_Puerto_Destino')->nullable();
            $table->string('contenedor')->nullable();
            $table->string('precio_unitario')->nullable();
            $table->string('tipo_interno')->nullable();
            $table->string('creacion_tipo')->nullable();
            $table->string('destruccion_tipo')->nullable();
            $table->string('Transporte')->nullable();
            $table->string('nota_calidad')->nullable();
            $table->string('n_nave')->nullable();
            $table->string('Numero_Embarque')->nullable();
            $table->string('N_Proceso')->nullable();
            $table->string('Estado')->nullable();

            $table->string('duplicado')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despachos');
    }
};
