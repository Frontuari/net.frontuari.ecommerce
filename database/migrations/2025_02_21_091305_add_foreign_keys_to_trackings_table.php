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
        Schema::table('trackings', function (Blueprint $table) {
            $table->foreign(['orders_status_id'], 'fk_tacking_estatus_pedido1_idx')->references(['id'])->on('orders_status')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['orders_id'], 'fk_tacking_pedido1_idx')->references(['id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['users_id'], 'fk_trackings_users1_idx')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trackings', function (Blueprint $table) {
            $table->dropForeign('fk_tacking_estatus_pedido1_idx');
            $table->dropForeign('fk_tacking_pedido1_idx');
            $table->dropForeign('fk_trackings_users1_idx');
        });
    }
};
