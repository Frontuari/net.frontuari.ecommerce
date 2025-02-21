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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('logo')->nullable();
            $table->bigInteger('nro_tienda')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->timestamps();
            $table->bigInteger('states_id')->nullable();
            $table->text('membrete')->nullable();
            $table->boolean('is_principal')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
