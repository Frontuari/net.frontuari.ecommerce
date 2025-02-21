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
        Schema::table('peoples', function (Blueprint $table) {
            $table->foreign(['cities_id'], 'fk_persona_cities1_idx')->references(['id'])->on('cities')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peoples', function (Blueprint $table) {
            $table->dropForeign('fk_persona_cities1_idx');
        });
    }
};
