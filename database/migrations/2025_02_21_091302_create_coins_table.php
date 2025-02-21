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
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('symbol', 10);
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->decimal('rate', 20, 9)->nullable()->default(1);
            $table->integer('coins_id')->nullable()->index('fk_coins_coins1_idx')->comment('Moneda base, sugerida por jorge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};
