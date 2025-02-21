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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->integer('categories_id')->index('fk_sub_categories_categories1_idx');
            $table->integer('c_elementvalue_id_n4')->nullable();
            $table->timestamps();
            $table->integer('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
