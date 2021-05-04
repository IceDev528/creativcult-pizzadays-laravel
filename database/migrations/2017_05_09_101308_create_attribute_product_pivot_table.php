<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeProductPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            
            $table->primary(['attribute_id', 'product_id']);
            $table->decimal('price',12,2)->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attribute_product');
    }
}