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
        Schema::create('det_tax_transports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('taxes_id')->index('fk_det_transport_taxes_taxes1_idx');
            $table->bigInteger('transports_id')->index('fk_det_transport_taxes_transports1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_tax_transports');
    }
};
