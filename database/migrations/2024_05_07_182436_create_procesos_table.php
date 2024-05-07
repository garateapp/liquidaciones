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
            $table->string('agricola');
            $table->integer('n_proceso');
            $table->string('especie');
            $table->string('variedad');
            $table->string('fecha');
            $table->integer('kilos_netos');
            $table->integer('id_empresa');
            $table->string('informe')->nullable();
            $table->integer('exp');
            $table->integer('comercial');
            $table->integer('desecho');
            $table->integer('merma');
            $table->string('c_productor')->nullable();

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
