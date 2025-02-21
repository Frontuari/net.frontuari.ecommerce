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
        Schema::create('trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->integer('orders_id')->index('fk_tacking_pedido1_idx');
            $table->bigInteger('orders_status_id')->index('fk_tacking_estatus_pedido1_idx');
            $table->bigInteger('users_id')->index('fk_trackings_users1_idx');
            $table->timestamps();
            $table->integer('enviado_email')->default(0);
            $table->integer('tiempo_min')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
