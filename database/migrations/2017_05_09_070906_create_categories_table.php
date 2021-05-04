<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('categories', function(Blueprint $table) {

                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->boolean('is_parent');
                $table->integer('parent_id')->nullable();
                $table->text('description')->nullable();
                $table->unique('slug');
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
        Schema::drop('categories');
    }

}
