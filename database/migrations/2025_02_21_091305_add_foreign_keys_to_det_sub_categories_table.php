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
        Schema::table('det_sub_categories', function (Blueprint $table) {
            $table->foreign(['sub_categories_id'], 'fk_det_sub_categories_products1_idx')->references(['id'])->on('sub_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['sub_categories_id'], 'fk_det_sub_categories_sub_categories1_idx')->references(['id'])->on('sub_categories')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_sub_categories', function (Blueprint $table) {
            $table->dropForeign('fk_det_sub_categories_products1_idx');
            $table->dropForeign('fk_det_sub_categories_sub_categories1_idx');
        });
    }
};
