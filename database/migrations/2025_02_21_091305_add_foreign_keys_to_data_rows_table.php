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
        Schema::table('data_rows', function (Blueprint $table) {
            $table->foreign(['data_type_id'])->references(['id'])->on('data_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_rows', function (Blueprint $table) {
            $table->dropForeign('data_rows_data_type_id_foreign');
        });
    }
};
