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
        Schema::create('recepcions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('temporada_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

                $table->string('c_empresa')->nullable();
                $table->string('tipo_g_recepcion')->nullable();
                $table->string('numero_g_recepcion')->nullable();
                $table->string('fecha_g_recepcion')->nullable();
                $table->string('n_transportista')->nullable();
                $table->string('id_exportadora')->nullable();
                $table->string('folio')->nullable();
                $table->string('fecha_cosecha')->nullable();
                $table->string('n_grupo')->nullable();
                $table->string('r_productor')->nullable();
                $table->string('c_productor')->nullable();
                $table->string('id_especie')->nullable();
                $table->string('n_especie')->nullable();
                $table->string('id_variedad')->nullable();
                $table->string('c_envase')->nullable();
                $table->string('c_categoria')->nullable();
                $table->string('t_categoria')->nullable();
                $table->string('c_calibre')->nullable();
                $table->string('c_serie')->nullable();
                $table->string('cantidad')->nullable();
                $table->string('peso_neto')->nullable();
                $table->string('destruccion_tipo')->nullable();
                $table->string('creacion_tipo')->nullable();
                $table->string('Notas')->nullable();
                $table->string('n_estado')->nullable();
                $table->string('N_tratamiento')->nullable();
                $table->string('n_tipo_cobro')->nullable();
                $table->string('N_productor_rotulado')->nullable();
                $table->string('CSG_productor_rotulado')->nullable();
                $table->string('destruccion_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepcions');
    }
};
