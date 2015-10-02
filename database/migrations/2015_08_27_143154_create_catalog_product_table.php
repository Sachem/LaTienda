<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create("catalog_products", function (Blueprint $table){

        $table->engine = 'InnoDB';

        $table->increments('id');

        $table->integer("category_id")->unsigned();
        $table->string("name", 150)->default("")->nullable();
        $table->longText("description")->nullable();
        $table->decimal("price", 10, 2)->nullable();
        $table->decimal("discounted_price", 10, 2)->nullable();
        $table->string("sku", 150)->default("")->nullable();
        $table->boolean("active")->default(1);
        $table->timestamps();
        
        $table->foreign('category_id')
                    ->references('id')
                    ->on('catalog_categories');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop("catalog_products");
    }
}
