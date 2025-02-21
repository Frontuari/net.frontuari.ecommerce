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
        Schema::create('biowallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('monto', 20);
            $table->string('tipo')->nullable()->default('Nuevo');
            $table->string('email');
            $table->text('observacion')->nullable();
            $table->bigInteger('orders_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biowallets');
    }
};
