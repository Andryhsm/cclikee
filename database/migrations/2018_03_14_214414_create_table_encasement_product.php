<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEncasementProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encasement_product', function (Blueprint $table) {
            $table->increments('encasement_product_id');
            $table->integer('encasement_id')->index('idx_encasement_id')->unsigned()->nullable();
            $table->integer('product_id')->index('idx_product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                ->references('product_id')->on('product');
            $table->integer('attribute_size_id')->unsigned()->nullable();
            $table->integer('attribute_color_id')->unsigned()->nullable();
            $table->integer('parent_category')->index('idx_parent_category')->unsigned()->nullable();
            $table->integer('sub_category')->index('idx_sub_category')->unsigned()->nullable();
            $table->integer('promo_code_id')->unsigned()->nullable();
            $table->integer('discount')->nullable();
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
        Schema::dropIfExists('encasement_product');
    }
}
