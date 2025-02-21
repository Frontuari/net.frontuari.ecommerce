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
        Schema::table('advs_stores', function (Blueprint $table) {
            $table->foreign(['advs_id'])->references(['id'])->on('advs')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['stores_id'])->references(['id'])->on('stores')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advs_stores', function (Blueprint $table) {
            $table->dropForeign('advs_stores_advs_id_foreign');
            $table->dropForeign('advs_stores_stores_id_foreign');
        });
    }
};
