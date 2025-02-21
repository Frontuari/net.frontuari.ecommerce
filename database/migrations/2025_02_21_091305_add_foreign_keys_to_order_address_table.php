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
        Schema::table('order_address', function (Blueprint $table) {
            $table->foreign(['cities_id'], 'fk_direccion_pedido_parroquia1_idx')->references(['id'])->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['users_id'], 'fk_order_address_users1_idx')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_address', function (Blueprint $table) {
            $table->dropForeign('fk_direccion_pedido_parroquia1_idx');
            $table->dropForeign('fk_order_address_users1_idx');
        });
    }
};
