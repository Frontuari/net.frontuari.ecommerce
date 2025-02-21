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
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->integer('regions_id')->index('fk_parroquia_municipio1_idx');
            $table->timestamps();
            $table->char('full_name', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
