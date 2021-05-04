<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('transactions', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('cart_id')->unsigned()->index();
                $table->string('transaction_id');
                $table->string('method');
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
        Schema::drop('transactions');
    }

}
