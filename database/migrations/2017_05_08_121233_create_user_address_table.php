<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('user_address_id');
			$table->integer('user_id')->index('idx_user_id')->unsigned();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('company')->nullable();
			$table->integer('phone')->nullable();
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('city');
			$table->integer('state_id');
			$table->integer('country_id');
			$table->string('zip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}
