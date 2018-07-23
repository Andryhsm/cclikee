<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->increments('store_id');
			$table->string('store_name');
			$table->integer('registration_number');
			$table->integer('phone');
			$table->string('email');
			$table->string('logo')->nullable();
			$table->string('shop_image')->nullable();
			$table->text('short_description')->nullable();
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('city');
			$table->string('zip');
			$table->integer('country_id');
			$table->integer('state_id');
			$table->double('latitude')->nullable();
			$table->double('longitude')->nullable();
			$table->integer('created_by')->index('idx_created_by')->unsigned()->nullable();
			$table->foreign('created_by')
				->references('admin_id')->on('admin')
				->onDelete('set null');
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
        Schema::dropIfExists('store');
    }
}
