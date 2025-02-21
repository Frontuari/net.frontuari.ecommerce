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
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cant')->default(1);
            $table->decimal('price', 20, 6);
            $table->decimal('total', 20, 6);
            $table->integer('orders')->index('fk_det_pedido_pedido1_idx');
            $table->decimal('deduction', 20, 6)->nullable();
            $table->bigInteger('cod_combo')->nullable()->index('fk_det_pedido_combo1_idx');
            $table->bigInteger('products_id')->index('fk_order_products_products1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
