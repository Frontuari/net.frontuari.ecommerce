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
        Schema::create('advs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('order')->nullable();
            $table->string('type', 50)->nullable();
            $table->timestamps();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->string('url')->nullable()->default('#');
            $table->integer('categories_id')->nullable()->index('fk_advs_categories1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advs');
    }
};
