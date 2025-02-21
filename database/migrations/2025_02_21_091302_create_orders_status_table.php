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
        Schema::create('orders_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_status');
    }
};
