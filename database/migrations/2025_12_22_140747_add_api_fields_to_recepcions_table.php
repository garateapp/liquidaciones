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
        Schema::table('recepcions', function (Blueprint $table) {

            // === Campos que devuelve tu API y no existen en local ===
            $table->string('n_empresa')->nullable()->after('c_empresa');

            $table->string('n_exportadora')->nullable()->after('id_exportadora');

            $table->string('id_productor')->nullable()->after('n_grupo');
            $table->string('n_productor')->nullable()->after('c_productor');

            $table->string('c_especie')->nullable()->after('id_especie');

            $table->string('c_variedad')->nullable()->after('id_variedad');
            $table->string('n_variedad')->nullable()->after('c_variedad');

            $table->string('n_envase')->nullable()->after('c_envase');

            $table->string('id_categoria')->nullable()->after('t_categoria');
            $table->string('n_categoria')->nullable()->after('c_categoria');

            $table->string('id_calibre')->nullable()->after('c_calibre');
            $table->string('n_calibre')->nullable()->after('id_calibre');

            $table->string('id_serie')->nullable()->after('id_calibre'); // o después de c_serie si prefieres
            $table->string('n_serie')->nullable()->after('c_serie');

            // nombre correcto según API
            $table->string('n_productor_rotulado')->nullable()->after('n_tipo_cobro');

            // === Índice UNIQUE para upsert correcto ===
            $table->unique([
                'temporada_id',
                'numero_g_recepcion',
                'folio',
                'id_productor',
                'id_variedad',
                'id_categoria',
                't_categoria',
                'id_calibre',
                'id_serie',
            ], 'recepcions_unique_sync_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recepcions', function (Blueprint $table) {
            //
        });
    }
};
