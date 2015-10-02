<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create("catalog_categories", function (Blueprint $table){

        $table->engine = 'InnoDB';

        $table->increments('id');

        $table->integer("parent_id")->unsigned()->default(0);$table->index("parent_id");
        $table->string("name", 150)->default("")->nullable();
        $table->text("description")->nullable();
        $table->string("url", 150)->default("")->nullable();
        $table->boolean("active");
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
      Schema::drop("catalog_categories");
    }
}
