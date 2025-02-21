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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('sub_total', 20);
            $table->decimal('total_pay', 20);
            $table->decimal('total_tax', 20);
            $table->decimal('total_packaging', 20)->nullable()->default(0);
            $table->decimal('total_transport', 20)->nullable()->default(0);
            $table->bigInteger('order_address_id')->nullable()->index('fk_pedido_direccion_pedido1_idx');
            $table->bigInteger('transports_id')->nullable()->index('fk_pedido_transporte1_idx');
            $table->smallInteger('user_rating')->nullable()->default(0);
            $table->timestamp('delivery_time_date')->nullable()->useCurrent();
            $table->decimal('discount', 20)->nullable()->default(0)->comment('para los combos');
            $table->decimal('exento', 20)->nullable()->default(0)->comment('exento de impuesto');
            $table->decimal('bi', 20)->nullable()->default(0)->comment('base imponible');
            $table->bigInteger('packagings_id')->index('fk_pedido_embalaje1_idx');
            $table->decimal('currency_rate', 20)->nullable()->default(1);
            $table->string('opinion')->nullable()->comment('Comentario del usuario para calificando el pedido');
            $table->integer('coins_id')->index('fk_orders_coins1_idx');
            $table->bigInteger('users_id')->nullable();
            $table->text('rate_json')->nullable();
            $table->timestamps();
            $table->string('status', 2)->nullable()->default('NU');
            $table->string('observacion')->nullable();
            $table->integer('enviado_bio')->default(0);
            $table->timestamp('fecha_enviado_bio')->nullable();
            $table->integer('email_pay_speed')->nullable();
            $table->bigInteger('stores_id')->nullable();
            $table->text('delivery_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
