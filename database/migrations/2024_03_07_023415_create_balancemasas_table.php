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

            $table->text('tipo_g_produccion')->nullable();
            $table->text('numero_g_produccion')->nullable();
            $table->text('fecha_g_produccion_sh')->nullable();
            $table->text('semana')->nullable();
            $table->text('folio')->nullable();
            $table->text('r_productor')->nullable();
            $table->text('c_productor')->nullable();
            $table->text('n_productor')->nullable();
            $table->text('n_especie')->nullable();
            $table->text('n_variedad')->nullable();
            $table->text('c_embalaje')->nullable();
            $table->text('n_embalaje')->nullable();
            $table->text('n_categoria')->nullable();
            $table->text('t_categoria')->nullable();
            $table->text('n_categoria_st')->nullable();
            $table->text('n_calibre')->nullable();
            $table->text('n_etiqueta')->nullable();
            $table->text('cantidad')->nullable();
            $table->text('peso_neto')->nullable();
            $table->text('tipo_transporte')->nullable();
            $table->text('precio_fob')->nullable();
            $table->text('exportadora')->nullable();
            $table->text('exportadora_embarque')->nullable();

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
