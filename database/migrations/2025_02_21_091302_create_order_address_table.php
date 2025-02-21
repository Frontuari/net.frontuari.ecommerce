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
        Schema::create('order_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cities_id')->index('fk_direccion_pedido_parroquia1_idx');
            $table->text('address');
            $table->enum('status', ['A', 'I'])->default('A');
            $table->bigInteger('users_id')->index('fk_order_address_users1_idx');
            $table->timestamps();
            $table->string('zip_code')->nullable();
            $table->string('urb')->nullable();
            $table->string('sector')->nullable();
            $table->string('nro_home')->nullable();
            $table->text('reference_point')->nullable();
            $table->string('type')->default('delivery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_address');
    }
};
