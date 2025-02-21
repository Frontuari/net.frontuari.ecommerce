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
        Schema::create('det_transport_cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transports_id')->index('fk_det_transporte_parroquia_transporte1_idx');
            $table->integer('cities_id')->index('fk_det_transporte_parroquia_parroquia1_idx');
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_transport_cities');
    }
};
