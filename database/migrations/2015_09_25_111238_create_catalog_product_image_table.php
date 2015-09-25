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
      Schema::create('catalog_product_image', function (Blueprint $table) {

        $table->engine = 'InnoDB';

        $table->increments('id');
        $table->integer("product_id")->unsigned();
        $table->integer("position")->unsigned();
        $table->string("filename", "100")->default("");
        $table->string("title", "100")->default("")->nullable();
        $table->timestamps();

        $table->foreign('product_id')
                ->references('id')
                ->on('catalog_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_product_image');
    }
}
