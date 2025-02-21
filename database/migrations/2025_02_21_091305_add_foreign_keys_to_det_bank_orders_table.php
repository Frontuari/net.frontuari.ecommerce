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
        Schema::table('det_bank_orders', function (Blueprint $table) {
            $table->foreign(['bank_datas_id'], 'fk_det_bank_orders_bank_datas1_idx')->references(['id'])->on('bank_datas')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['orders_id'], 'fk_det_bank_orders_orders1_idx')->references(['id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_bank_orders', function (Blueprint $table) {
            $table->dropForeign('fk_det_bank_orders_bank_datas1_idx');
            $table->dropForeign('fk_det_bank_orders_orders1_idx');
        });
    }
};
