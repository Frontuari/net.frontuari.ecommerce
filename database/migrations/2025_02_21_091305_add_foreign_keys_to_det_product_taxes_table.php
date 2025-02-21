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
        Schema::table('det_product_taxes', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_det_product_taxes_products1_idx')->references(['id'])->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['taxes_id'], 'fk_det_product_taxes_taxes1_idx')->references(['id'])->on('taxes')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_product_taxes', function (Blueprint $table) {
            $table->dropForeign('fk_det_product_taxes_products1_idx');
            $table->dropForeign('fk_det_product_taxes_taxes1_idx');
        });
    }
};
