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
        Schema::table('rating_products', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_rating_products_products1_idx')->references(['id'])->on('products')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['users_id'], 'fk_rating_products_users1_idx')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rating_products', function (Blueprint $table) {
            $table->dropForeign('fk_rating_products_products1_idx');
            $table->dropForeign('fk_rating_products_users1_idx');
        });
    }
};
