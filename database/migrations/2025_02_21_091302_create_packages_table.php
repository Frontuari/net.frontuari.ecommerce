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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->decimal('discount', 20, 6)->nullable()->default(0);
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
            $table->string('image')->default('#');
            $table->string('type', 50)->default('IZ');
            $table->bigInteger('stores_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
