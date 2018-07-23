<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStoreCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_customer', function(Blueprint $table){
            $table->increments('store_customer_id');
            $table->integer('type_customer');
            $table->integer('store_id')->index('idx_store_id')->unsigned();
            $table->integer('user_id')->index('idx_user_id')->unsigned();
            $table->foreign('store_id')
                ->references('store_id')->on('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_customer');
    }
}
