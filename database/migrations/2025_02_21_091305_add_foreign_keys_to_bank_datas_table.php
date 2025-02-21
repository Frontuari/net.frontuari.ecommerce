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
        Schema::table('bank_datas', function (Blueprint $table) {
            $table->foreign(['stores_id'])->references(['id'])->on('stores')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['banks_id'], 'fk_bank_data_banks1_idx')->references(['id'])->on('banks')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['coins_id'], 'fk_bank_datas_coins1_idx')->references(['id'])->on('coins')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['payment_methods_id'], 'fk_bank_datas_payment_methods1_idx')->references(['id'])->on('payment_methods')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_datas', function (Blueprint $table) {
            $table->dropForeign('bank_datas_stores_id_foreign');
            $table->dropForeign('fk_bank_data_banks1_idx');
            $table->dropForeign('fk_bank_datas_coins1_idx');
            $table->dropForeign('fk_bank_datas_payment_methods1_idx');
        });
    }
};
