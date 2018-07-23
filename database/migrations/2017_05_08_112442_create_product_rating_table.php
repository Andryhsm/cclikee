<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_rating', function (Blueprint $table) {
            $table->increments('product_rating_id');
			$table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->binary('status');
			$table->integer('user_id')->index('idx_user_id')->unsigned();
			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('cascade');
			$table->string('nickname')->nullable();
			$table->string('title')->nullable();
			$table->text('review');
			$table->timestamp('review_date');
			$table->integer('rating');
			$table->integer('helpful_count');
			$table->integer('flagged_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_rating');
    }
}
