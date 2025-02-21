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
        Schema::create('det_product_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cant')->nullable();
            $table->bigInteger('packages_id')->index('fk_det_product_packages_packages1_idx');
            $table->bigInteger('products_id')->index('fk_det_product_packages_products1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_product_packages');
    }
};
