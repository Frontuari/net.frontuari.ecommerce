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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('last_ip')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->integer('failed_attempts')->nullable()->default(0);
            $table->integer('validateemail')->nullable()->default(0);
            $table->integer('cant_orders')->nullable()->default(0);
            $table->bigInteger('peoples_id')->nullable();
            $table->bigInteger('coins_id')->nullable();
            $table->bigInteger('groups_id')->nullable();
            $table->bigInteger('currency_id')->nullable();
            $table->integer('purchase_quantity')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->string('avatar')->nullable()->default('users/default.png');
            $table->bigInteger('role_id')->nullable();
            $table->text('settings')->nullable();
            $table->decimal('saldo', 20)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
