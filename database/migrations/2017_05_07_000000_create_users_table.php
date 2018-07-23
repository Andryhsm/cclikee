<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('role_id')->index('idx_role_id')->unsigned()->nullable();
			$table->foreign('role_id')
				->references('role_id')->on('user_role')
				->onDelete('set null');
			$table->string('first_name');
            $table->string('last_name');
            $table->string('email_address');
            $table->string('password');
            $table->binary('status');
            $table->string('phone_number')->nullable();
			$table->rememberToken()->nullable();
			$table->string('profile_image')->nullable();
			$table->string('position')->nullable();
			$table->integer('radius')->nullable();
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
        Schema::dropIfExists('users');
    }
}
