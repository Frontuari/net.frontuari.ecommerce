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
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name', 45);
            $table->string('name')->nullable();
            $table->decimal('value', 20, 6)->nullable();
            $table->enum('type', ['porc', 'fijo'])->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
