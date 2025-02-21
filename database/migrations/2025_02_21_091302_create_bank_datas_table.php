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
        Schema::create('bank_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titular', 90);
            $table->text('description')->nullable();
            $table->char('account_type', 1)->nullable();
            $table->integer('banks_id')->index('fk_bank_data_banks1_idx');
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
            $table->integer('payment_methods_id')->index('fk_bank_datas_payment_methods1_idx');
            $table->integer('coins_id')->index('fk_bank_datas_coins1_idx');
            $table->bigInteger('stores_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_datas');
    }
};
