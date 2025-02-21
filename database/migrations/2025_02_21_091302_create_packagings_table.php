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
        Schema::create('packagings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->decimal('value', 20, 6)->nullable()->default(0);
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packagings');
    }
};
