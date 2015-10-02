<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('catalog_product_images', function (Blueprint $table) {

        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->integer("product_id")->unsigned();
        $table->integer("position")->default(0)->unsigned();
        $table->string("extension", "4")->default("");
        $table->string("title", "100")->default("")->nullable();
        $table->timestamps();

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
        Schema::drop('catalog_product_images');
    }
}
