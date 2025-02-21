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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['coins_id'], 'fk_orders_coins1_idx')->references(['id'])->on('coins')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['order_address_id'], 'fk_pedido_direccion_pedido1_idx')->references(['id'])->on('order_address')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['packagings_id'], 'fk_pedido_embalaje1_idx')->references(['id'])->on('packagings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['transports_id'], 'fk_pedido_transporte1_idx')->references(['id'])->on('transports')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['stores_id'])->references(['id'])->on('stores')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('fk_orders_coins1_idx');
            $table->dropForeign('fk_pedido_direccion_pedido1_idx');
            $table->dropForeign('fk_pedido_embalaje1_idx');
            $table->dropForeign('fk_pedido_transporte1_idx');
            $table->dropForeign('orders_stores_id_foreign');
        });
    }
};
