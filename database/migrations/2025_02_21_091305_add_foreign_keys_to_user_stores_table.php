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
        Schema::table('user_stores', function (Blueprint $table) {
            $table->foreign(['stores_id'])->references(['id'])->on('stores')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['users_id'])->references(['id'])->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_stores', function (Blueprint $table) {
            $table->dropForeign('user_stores_stores_id_foreign');
            $table->dropForeign('user_stores_users_id_foreign');
        });
    }
};
