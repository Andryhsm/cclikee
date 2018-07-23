<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('special_product', function (Blueprint $table) {
            $table->increments('special_product_id');
            $table->enum('type', ['1', '2','3']);
            $table->integer('product_id')->index('idx_product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                ->references('product_id')->on('product')
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
        //
    }
}
