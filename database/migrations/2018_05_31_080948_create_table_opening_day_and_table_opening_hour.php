<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOpeningDayAndTableOpeningHour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_opening_day', function(Blueprint $table){
           $table->increments('opening_day_id');
           $table->string('day_name');
        });
        Schema::create('store_opening_hour', function(Blueprint $table){
           $table->increments('opening_hour_id');
           $table->time('opening_hour')->nullable();
           $table->time('closure_hour')->nullable();
           $table->integer('opening_day_id')->index('idx_opening_day_id')->unsigned();
           $table->integer('store_id')->index('idx_store_id')->unsigned();
           $table->foreign('store_id')->references('store_id')->on('store')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_opening_day');
        Schema::dropIfExists('store_opening_hour');
    }
}
