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
        Schema::create('balancemasas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade');
            
            $table->text('id_g_produccion');
            $table->text('tipo_g_produccion');
            $table->text('numero_g_produccion');
            $table->text('fecha_g_produccion');
            $table->text('fecha_g_produccion_sh');
            $table->text('id_exportadora')->nullable();
            $table->text('r_exportadora')->nullable();
            $table->text('c_exportadora')->nullable();
            $table->text('n_exportadora')->nullable();
            $table->text('folio')->nullable();
            $table->text('id_altura')->nullable();
            $table->text('c_altura')->nullable();
            $table->text('n_altura')->nullable();
            $table->text('fecha_cosecha')->nullable();
            $table->text('fecha_produccion')->nullable();
            $table->text('id_grupo')->nullable();
            $table->text('r_grupo')->nullable();
            $table->text('n_grupo')->nullable();
            $table->text('id_productor')->nullable();
            $table->text('r_productor')->nullable();
            $table->text('c_productor')->nullable();
            $table->text('n_productor')->nullable();
            $table->text('ns_productor')->nullable();

            $table->text('id_predio')->nullable();
            $table->text('c_precio')->nullable();
            $table->text('n_predio')->nullable();
            $table->text('id_cuartel')->nullable();
            $table->text('c_cuartel')->nullable();
            $table->text('n_cuartel')->nullable();
            $table->text('id_centrocosto')->nullable();
            $table->text('c_centrocosto')->nullable();
            $table->text('n_centrocosto')->nullable();
            $table->text('id_familia')->nullable();
            $table->text('c_familia')->nullable();
            $table->text('n_familia')->nullable();
            $table->text('id_especie')->nullable();
            $table->text('c_especie')->nullable();
            $table->text('n_especie')->nullable();
            $table->text('peso_equivalente_especie')->nullable();
            $table->text('id_variedad')->nullable();
          
            $table->text('c_variedad')->nullable();
            $table->text('n_variedad')->nullable();
            $table->text('id_embalaje')->nullable();
            $table->text('c_embalaje')->nullable();
            $table->text('n_embalaje')->nullable();
            $table->text('cp1')->nullable();
            $table->text('cp2')->nullable();
            $table->text('peso_std_embalaje')->nullable();
            $table->text('peso_standard')->nullable();
            $table->text('id_contenedor')->nullable();
            $table->text('c_contenedor')->nullable();
            $table->text('n_contenedor')->nullable();

            $table->text('id_categoria')->nullable();
            $table->text('c_categoria')->nullable();
            $table->text('n_vategoria')->nullable();
            $table->text('t_categoria')->nullable();
            $table->text('id_categoria_st')->nullable();
            $table->text('n_categoria_st')->nullable();
            $table->text('id_calibre')->nullable();
            $table->text('c_calibre')->nullable();
            $table->text('n_calibre')->nullable();
            $table->text('id_serie')->nullable();
            $table->text('c_serie')->nullable();
            $table->text('n_serie')->nullable();

            $table->text('id_etiqueta')->nullable();
            $table->text('c_etiqueta')->nullable();
            $table->text('n_etiqueta')->nullable();
            $table->text('id_plu')->nullable();
            $table->text('c_plu')->nullable();
            $table->text('n_plu')->nullable();
            $table->text('cantidad')->nullable();
            $table->text('peso_neto')->nullable();
            $table->text('id_productor_rotulacion')->nullable();
            $table->text('r_productor_rotulacion')->nullable();
            $table->text('c_productor_rotulacion')->nullable();
            $table->text('n_productor_rotulacion')->nullable();

            $table->text('ns_productor_rotulacion')->nullable();
            $table->text('cp1_productor_rotulacion')->nullable();
            $table->text('id_familia_rotulacion')->nullable();
            $table->text('c_familia_rotulacion')->nullable();
            //
            $table->text('n_familia_rotulacion')->nullable();
            $table->text('id_especie_rotulacion')->nullable();
            $table->text('c_especie_rotulacion')->nullable();
            $table->text('n_especie_rotulacion')->nullable();

            $table->text('id_variedad_rotulacion')->nullable();
            $table->text('c_variedad_rotulacion')->nullable();
            $table->text('n_variedad_rotulacion')->nullable();
            $table->text('id_empresa')->nullable();

            $table->text('ngd_recepcion')->nullable();
            $table->text('fecha_documento')->nullable();
            $table->text('fecha_documento_sh')->nullable();
            $table->text('id_linea_proceso')->nullable();
            $table->text('c_linea_proceso')->nullable();
            $table->text('n_linea_proceso')->nullable();
            $table->text('numero_gruia_recepcion')->nullable();
            $table->text('fecha_recepcion')->nullable();

            $table->text('id_turno')->nullable();
            $table->text('n_turno')->nullable();
            $table->text('id_tipo_proceso')->nullable();
            $table->text('n_tipo_proceso')->nullable();
            $table->text('id_condicion')->nullable();
            $table->text('c_condicion')->nullable();
            $table->text('n_condicion')->nullable();

            $table->text('id_grupo_proceso')->nullable();
            $table->text('c_grupo_proceso')->nullable();
            $table->text('n_grupo_proceso')->nullable();
            $table->text('peso_equivalente')->nullable();
            $table->text('id_cliente_packing')->nullable();
            $table->text('r_cliente_packing')->nullable();
            $table->text('c_cliente_packing')->nullable();
            $table->text('n_cliente_packing')->nullable();

            $table->text('fecha_cosecha_sf')->nullable();
            $table->text('fecha_produccion_sf')->nullable();
            $table->text('ngi_recepcion')->nullable();
            $table->text('creacion_tipo')->nullable();
            $table->text('c_marca')->nullable();
            $table->text('n_marca')->nullable();
            $table->text('id_variedad_comercial')->nullable();
            $table->text('c_variedad_comercial')->nullable();
            $table->text('n_variedad_comercial')->nullable();
            //
            $table->text('orden_interno_calibre')->nullable();
            $table->text('c_bodega_origen')->nullable();
            $table->text('n_bodega_origen')->nullable();
            $table->text('numero_trabajores')->nullable();
            $table->text('hora_termino')->nullable();
            $table->text('hora_inicio')->nullable();
            $table->text('horas_efectivas')->nullable();
            $table->text('c_recibidor')->nullable();
            $table->text('r_packing_origen')->nullable();
            $table->text('n_packing_origen')->nullable();
            $table->text('ns_packing_origen')->nullable();
            $table->text('c_packing_origen')->nullable();

            $table->text('nota_calidad')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('kg_aditivos')->nullable();

            $table->text('n_docaditivo')->nullable();
            $table->text('c_aditivo')->nullable();
            $table->text('n_aditivo')->nullable();
            $table->text('referencias')->nullable();

            $table->text('notas')->nullable();
            $table->text('csg')->nullable();
            $table->text('csg_productor')->nullable();
            $table->text('estado')->nullable();
            $table->text('id_marca_etiqueta')->nullable();
            $table->text('c_marca_etiqueta')->nullable();
            $table->text('n_marca_etiqueta')->nullable();
            $table->text('loter_unitec')->nullable();

            $table->text('id_check')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balancemasas');
    }
};
