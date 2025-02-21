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
        Schema::table('advs', function (Blueprint $table) {
            $table->foreign(['categories_id'], 'fk_advs_categories1_idx')->references(['id'])->on('categories')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advs', function (Blueprint $table) {
            $table->dropForeign('fk_advs_categories1_idx');
        });
    }
};
