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
        Schema::create('det_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('products_id')->index('fk_det_sub_categories_products1_idx');
            $table->integer('sub_categories_id')->index('fk_det_sub_categories_sub_categories1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_sub_categories');
    }
};
