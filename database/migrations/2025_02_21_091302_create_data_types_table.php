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
        Schema::create('data_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('display_name_singular');
            $table->string('display_name_plural');
            $table->string('icon')->nullable();
            $table->string('model_name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('generate_permissions')->default(false);
            $table->timestamps();
            $table->smallInteger('server_side')->default(0);
            $table->string('controller')->nullable();
            $table->string('policy_name')->nullable();
            $table->text('details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_types');
    }
};
