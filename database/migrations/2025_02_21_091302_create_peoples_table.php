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
        Schema::create('peoples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rif', 18);
            $table->string('name');
            $table->enum('sex', ['m', 'f', 'o'])->nullable()->comment('Masculino (m)
Femenino (f)
Otros (o)');
            $table->date('birthdate')->nullable();
            $table->char('phone', 12)->nullable();
            $table->integer('cities_id')->index('fk_persona_cities1_idx');
            $table->timestamps();
            $table->char('phone_home', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
