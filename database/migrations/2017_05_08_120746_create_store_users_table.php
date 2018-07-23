<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_users', function (Blueprint $table) {
            $table->integer('store_id')->index('store_id')->unsigned();
			$table->foreign('store_id')
				->references('store_id')->on('store')
				->onDelete('cascade');
			$table->integer('user_id')->index('idx_user_id')->unsigned();
			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('cascade');
			$table->binary('is_global_manager')->nullable();
			$table->binary('compte_principal')->nullable();
			$table->binary('receive_request')->nullable();
			$table->binary('reply_request')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_users');
    }
}
