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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->index('fk_products_name1_idx');
            $table->string('description_short')->nullable()->index('fk_products_short1_idx');
            $table->text('description')->nullable();
            $table->decimal('price', 20, 6);
            $table->integer('qty_avaliable')->nullable()->default(0);
            $table->integer('qty_sold')->nullable()->default(0);
            $table->integer('qty_view')->nullable()->default(0);
            $table->float('user_rating', null, 0)->nullable()->default(0);
            $table->integer('qty_min')->nullable()->default(1)->comment('Cantidad minima de compra');
            $table->integer('qty_max')->nullable()->default(0)->comment('Cantidad maxima a vender si es 0 significa que es infinito');
            $table->string('keyword')->nullable();
            $table->enum('status', ['A', 'I'])->nullable()->default('A');
            $table->string('EAN', 20)->nullable()->unique('ean_unique')->comment('codigo de barras');
            $table->integer('sku')->nullable();
            $table->smallInteger('promote')->nullable()->default(0);
            $table->decimal('discount', 20, 6)->nullable()->default(0);
            $table->string('photo', 200)->nullable();
            $table->string('mark_keyword')->nullable();
            $table->integer('stores_id')->index('fk_products_stores1_idx');
            $table->integer('brands_id')->nullable()->index('fk_products_brands1_idx');
            $table->integer('sub_categories_id')->index('fk_products_sub_categories1_idx');
            $table->enum('is_combo', ['0', '1'])->nullable()->default('0');
            $table->timestamps();
            $table->decimal('peso', 20, 6)->default(0);
            $table->integer('m_product_id')->nullable()->unique();
            $table->integer('porc_stock')->nullable()->default(100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
