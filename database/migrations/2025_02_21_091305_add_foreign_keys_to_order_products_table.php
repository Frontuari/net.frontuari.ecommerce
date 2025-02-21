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
        Schema::table('order_products', function (Blueprint $table) {
            $table->foreign(['cod_combo'], 'fk_det_pedido_combo1_idx')->references(['id'])->on('packages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['orders'], 'fk_det_pedido_pedido1_idx')->references(['id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['products_id'], 'fk_order_products_products1_idx')->references(['id'])->on('products')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign('fk_det_pedido_combo1_idx');
            $table->dropForeign('fk_det_pedido_pedido1_idx');
            $table->dropForeign('fk_order_products_products1_idx');
        });
    }
};
