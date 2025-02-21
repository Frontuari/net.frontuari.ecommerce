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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['brands_id'], 'fk_products_brands1_idx')->references(['id'])->on('brands')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['stores_id'], 'fk_products_stores1_idx')->references(['id'])->on('stores')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['sub_categories_id'], 'fk_products_sub_categories1_idx')->references(['id'])->on('sub_categories')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('fk_products_brands1_idx');
            $table->dropForeign('fk_products_stores1_idx');
            $table->dropForeign('fk_products_sub_categories1_idx');
        });
    }
};
