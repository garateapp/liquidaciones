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
        Schema::table('embarques', function (Blueprint $table) {
            $table->dateTime('fecha_embarque_dt')->nullable()->after('fecha_embarque')->index();
            $table->dateTime('fecha_despacho_dt')->nullable()->after('fecha_despacho')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('embarques', function (Blueprint $table) {
            //
        });
    }
};
