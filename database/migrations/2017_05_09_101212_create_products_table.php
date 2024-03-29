<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('products', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->integer('category_id');
                $table->text('description');
                $table->string('image', 512);
                $table->string('path');

                $table->timestamps();
                $table->softDeletes();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }

}
