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
        Schema::table('det_transport_cities', function (Blueprint $table) {
            $table->foreign(['cities_id'], 'fk_det_transporte_parroquia_parroquia1_idx')->references(['id'])->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['transports_id'], 'fk_det_transporte_parroquia_transporte1_idx')->references(['id'])->on('transports')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_transport_cities', function (Blueprint $table) {
            $table->dropForeign('fk_det_transporte_parroquia_parroquia1_idx');
            $table->dropForeign('fk_det_transporte_parroquia_transporte1_idx');
        });
    }
};
