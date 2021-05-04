<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('vouchers', function(Blueprint $table) {
                $table->increments( 'id' );
    
                // The voucher code
                $table->string( 'code' )->nullable();

                // The human readable voucher code name
                $table->string( 'name' )->nullable();

                // The description of the voucher - Not necessary 
                $table->text('description')->nullable();
                $table->string('voucher_type')->nullable();

                $table->integer('location_id')->unsigned()->nullable();
               
                $table->integer('zip_code_id')->unsigned()->nullable();

                $table->integer('user_id')->unsigned()->nullable();

                 // The number of uses currently
                $table->integer('uses')->unsigned()->default(0);

                // The max uses this voucher has
                $table->integer('max_uses')->unsigned()->nullable();

                // How many times a user can use this voucher.
                $table->integer('max_uses_user')->unsigned()->default(1);

                // The type can be: voucher, discount, sale. What ever you want.
                // $table->text('type');

                // Whether or not the voucher is a percentage or a fixed price. 
                $table->boolean('is_fixed')->default(true);
                // The amount to discount by (in pennies) in this example.
                $table->integer('discount_amount');

                
                
                // When the voucher begins
                $table->dateTime('starts_at')->nullable();

                // When the voucher ends
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create( 'user_voucher', function ( Blueprint $table ) {
                $table->integer( 'user_id' )->unsigned( );
                $table->bigInteger( 'voucher_id' )->unsigned( );

                // $table->unique( [ 'user_id', 'voucher_id' ] );
                  $table->timestamps();
            });

            Schema::create( 'cart_voucher', function ( Blueprint $table ) {
                $table->integer( 'cart_id' )->unsigned( );
                $table->bigInteger( 'voucher_id' )->unsigned( );

                $table->unique( [ 'cart_id', 'voucher_id' ] );
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
        Schema::drop('vouchers');
        Schema::drop('user_voucher');
        Schema::drop('cart_voucher');
    }

}
