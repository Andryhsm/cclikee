<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEncasementOrderLastReset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encasement_order_last_reset', function(Blueprint $table){
           $table->increments('id');
           $table->decimal('total_price', 10, 2);
           $table->timestamps();
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
        Schema::dropIfExists('encasement_order_last_reset');
    }
}
