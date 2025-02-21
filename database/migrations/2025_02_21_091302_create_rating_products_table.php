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
        Schema::create('rating_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('rating')->default(0);
            $table->string('opinion')->nullable();
            $table->bigInteger('products_id')->index('fk_rating_products_products1_idx');
            $table->bigInteger('users_id')->index('fk_rating_products_users1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_products');
    }
};
