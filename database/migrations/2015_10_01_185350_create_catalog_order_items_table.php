<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('quantity');
            $table->timestamps();
            
            $table->foreign('order_id')
                    ->references('id')
                    ->on('catalog_orders');
            
            $table->foreign('product_id')
                    ->references('id')
                    ->on('catalog_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_order_items');
    }
}
