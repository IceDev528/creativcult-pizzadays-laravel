<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('locations', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                // $table->integer('user_id')->unsigned()->nullable();
               
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
        Schema::drop('locations');
    }

}
