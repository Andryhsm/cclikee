<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('wishlist_id');
			$table->integer('user_id')->index('idx_user_id')->unsigned();
/*			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('cascade');*/
			$table->integer('product_id')->index('idx_product_id')->unsigned();
/*			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');*/
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
        Schema::dropIfExists('wishlists');
    }
}
