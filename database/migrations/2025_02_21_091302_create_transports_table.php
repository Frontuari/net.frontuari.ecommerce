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
        Schema::create('transports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->decimal('price', 20, 6)->nullable()->default(0);
            $table->integer('time_minutes')->nullable()->default(0);
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
            $table->text('peso_max')->default('15');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
