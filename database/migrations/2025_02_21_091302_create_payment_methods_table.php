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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->integer('time_minutes')->nullable()->default(0)->comment('tiempo en hacerce efectivo el pago');
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
