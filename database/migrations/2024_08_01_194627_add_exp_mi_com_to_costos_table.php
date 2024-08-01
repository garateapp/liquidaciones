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
        Schema::table('costos', function (Blueprint $table) {
            $table->boolean('exp')->nullable();
            $table->boolean('mi')->nullable();
            $table->boolean('com')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costos', function (Blueprint $table) {
            $table->dropColumn(['exp', 'mi', 'com']);
        });
    }
};
