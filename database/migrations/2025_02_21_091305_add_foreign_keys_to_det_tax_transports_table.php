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
        Schema::table('det_tax_transports', function (Blueprint $table) {
            $table->foreign(['taxes_id'], 'fk_det_transport_taxes_taxes1_idx')->references(['id'])->on('taxes')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['transports_id'], 'fk_det_transport_taxes_transports1_idx')->references(['id'])->on('transports')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_tax_transports', function (Blueprint $table) {
            $table->dropForeign('fk_det_transport_taxes_taxes1_idx');
            $table->dropForeign('fk_det_transport_taxes_transports1_idx');
        });
    }
};
