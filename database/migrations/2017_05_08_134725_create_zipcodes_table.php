<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZipcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('zipcodes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('location_id')->unsigned();
                $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
        Schema::drop('zipcodes');
    }

}
