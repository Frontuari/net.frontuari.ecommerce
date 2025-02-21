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
        Schema::table('det_group_events', function (Blueprint $table) {
            $table->foreign(['events_id'], 'fk_det_group_events_events1_idx')->references(['id'])->on('events')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['groups_id'], 'fk_det_group_events_groups1_idx')->references(['id'])->on('groups')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('det_group_events', function (Blueprint $table) {
            $table->dropForeign('fk_det_group_events_events1_idx');
            $table->dropForeign('fk_det_group_events_groups1_idx');
        });
    }
};
