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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 200)->nullable();
            $table->text('body')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->string('imagen', 200)->nullable();
            $table->timestamps();
            $table->string('observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
