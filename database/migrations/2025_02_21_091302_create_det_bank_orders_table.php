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
        Schema::create('det_bank_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 20)->nullable();
            $table->integer('orders_id')->index('fk_det_bank_orders_orders1_idx');
            $table->integer('bank_datas_id')->index('fk_det_bank_orders_bank_datas1_idx');
            $table->string('status', 45)->nullable()->default('nuevo');
            $table->string('ref', 200)->nullable();
            $table->string('image', 250)->nullable();
            $table->timestamps();
            $table->decimal('other_amount', 20)->nullable();
            $table->bigInteger('coins_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('users_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_bank_orders');
    }
};
