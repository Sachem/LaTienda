<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->integer('delivery_address_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            
            $table->foreign('payment_id')
                    ->references('id')
                    ->on('payments');
            
            $table->foreign('delivery_address_id')
                    ->references('id')
                    ->on('order_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_orders');
    }
}
