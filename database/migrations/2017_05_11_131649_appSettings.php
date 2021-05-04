<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appsettings', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('tax')->unsigned()->default(7);
                $table->string('currency')->default('&euro;');
                $table->text('disabled_dates')->nullable();
                //week days 
                $table->time('mon_start')->default('08:00:00');
                $table->time('mon_end')->default('22:00:00');

                $table->time('tue_start')->default('08:00:00');
                $table->time('tue_end')->default('22:00:00');

                $table->time('wed_start')->default('08:00:00');
                $table->time('wed_end')->default('22:00:00');

                $table->time('thu_start')->default('08:00:00');
                $table->time('thu_end')->default('22:00:00');

                $table->time('fri_start')->default('08:00:00');
                $table->time('fri_end')->default('22:00:00');

                $table->time('sat_start')->default('08:00:00');
                $table->time('sat_end')->default('22:00:00');

                $table->time('sun_start')->default('08:00:00');
                $table->time('sun_end')->default('22:00:00');

                $table->string('closed_weekdays')->nullable();
                //Week End dates
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
         Schema::drop('appsettings');
    }
}
