<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('address_type', ['delivery', 'billing'])->default('delivery');
            $table->string('address_line_1', 20);
            $table->string('address_line_2', 200);
            $table->string('city', 100);
            $table->string('postcode', 10);
            $table->string('phone_number', 20);
            $table->text('delivery_instructions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_addresses');
    }
}
