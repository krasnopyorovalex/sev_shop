<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_catalog_products', static function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('catalog_product_id');

            $table->unsignedMediumInteger('total');
            $table->unsignedSmallInteger('quantity');

            $table->primary(['order_id', 'catalog_product_id'], 'pmc_orders_catalog_products');

            $table->index(['order_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('catalog_product_id')->references('id')->on('catalog_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_catalog_products');
    }
}
