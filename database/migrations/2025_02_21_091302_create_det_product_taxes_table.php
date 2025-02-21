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
        Schema::create('det_product_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxes_id')->index('fk_det_product_taxes_taxes1_idx');
            $table->bigInteger('products_id')->index('fk_det_product_taxes_products1_idx');

            $table->unique(['taxes_id', 'products_id'], 'det_product_taxes_taxes_id_products_id_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_product_taxes');
    }
};
