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
        Schema::create('det_group_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('groups_id')->index('fk_det_group_events_groups1_idx');
            $table->integer('events_id')->index('fk_det_group_events_events1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_group_events');
    }
};
