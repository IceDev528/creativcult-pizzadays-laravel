<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('favourite')->default(0);
            $table->string('favourite_name')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
      
        Schema::create('cart_product', function (Blueprint $table) {
            $table->integer('cart_id')->unsigned()->index();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('attribute')->unsigned();
            $table->integer('quantity')->unsigned();
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
         Schema::drop('carts');
         Schema::drop('cart_product');
    }
}
