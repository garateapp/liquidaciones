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
        Schema::table('fobs', function (Blueprint $table) {
            $table->string('fob_kilo_salida2')->nullable();
            $table->string('fob_kilo_salida3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fobs', function (Blueprint $table) {
            //
        });
    }
};
