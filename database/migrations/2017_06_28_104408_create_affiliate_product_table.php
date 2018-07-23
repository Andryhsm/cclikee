<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('affiliate_product', function (Blueprint $table) {
            $table->increments('affiliate_product_id');
            $table->string('product_id');
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->decimal('price',12,2);
            $table->string('product_url');
            $table->string('product_image')->nullable();
            $table->string('logo_image')->nullable();
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
        //
        Schema::drop('affiliate_product');
    }
}
