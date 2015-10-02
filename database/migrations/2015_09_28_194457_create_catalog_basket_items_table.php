<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogBasketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_basket_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('basket_id')
                ->references('id')
                ->on('catalog_baskets');
            
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
        Schema::drop('catalog_basket_items');
    }
}
