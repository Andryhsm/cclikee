<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodePromoProductsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_promo_product', function (Blueprint $table){
            $table->integer('code_promo_id')->index('idx_code_promo_id')->unsigned()->nullable();
            $table->foreign('code_promo_id')
                ->references('code_promo_id')->on('code_promo')
                ->onDelete('cascade');
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
        Schema::dropIfExists('code_promo_product');
    }
}
