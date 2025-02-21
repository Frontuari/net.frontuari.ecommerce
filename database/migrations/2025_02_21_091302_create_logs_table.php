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
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip', 18)->nullable();
            $table->text('description')->nullable();
            $table->string('type', 50)->nullable()->comment('El tipo puede definir si es un error o un movimiento del usuario, ejemplo para saber si un usuario modifico un producto');
            $table->bigInteger('users_id')->index('fk_logs_users1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
