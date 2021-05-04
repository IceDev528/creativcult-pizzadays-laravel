<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('orders', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->index();
                $table->integer('cart_id')->unsigned()->index();
                
                $table->string('method');
                $table->string('total');
                $table->boolean('status')->default(0);
                $table->dateTime('date_delivery');
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
         Schema::drop('orders');
    }

}
