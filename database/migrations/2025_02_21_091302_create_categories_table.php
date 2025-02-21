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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->string('image', 200)->nullable();
            $table->integer('parent_id')->nullable()->index('fk_categories_categories1_idx');
            $table->smallInteger('order')->nullable()->default(1);
            $table->string('slug')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->integer('c_elementvalue_id_n3')->nullable();
            $table->timestamps();
            $table->enum('adulto', ['N', 'Y'])->nullable()->default('N');
            $table->string('image_b')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
