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
            $table->string('delivery_address_line_1');
            $table->string('delivery_address_line_2');
            $table->string('delivery_city');
            $table->string('delivery_postcode');
            $table->string('delivery_phone_number');
            $table->string('delivery_instructions');
            $table->timestamps();
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            
            $table->foreign('payment_id')
                    ->references('id')
                    ->on('payments');
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
