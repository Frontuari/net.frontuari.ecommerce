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
        Schema::table('det_product_packages', function (Blueprint $table) {
            $table->foreign(['packages_id'], 'fk_det_product_packages_packages1_idx')->references(['id'])->on('packages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['products_id'], 'fk_det_product_packages_products1_idx')->references(['id'])->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_product_packages', function (Blueprint $table) {
            $table->dropForeign('fk_det_product_packages_packages1_idx');
            $table->dropForeign('fk_det_product_packages_products1_idx');
        });
    }
};
