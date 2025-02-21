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
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_id')->index('fk_favorito_usuario1_idx');
            $table->bigInteger('products_id')->index('fk_favorites_products1_idx');
            $table->timestamps();

            $table->unique(['products_id', 'users_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
