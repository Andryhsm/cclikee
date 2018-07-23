<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysUrlRewriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_url_rewrite', function (Blueprint $table) {
            $table->increments('sys_url_rewrite_id');
			$table->string('request_url');
			$table->string('target_url');
			$table->enum('type',['1','2','3'])->comment('1 => Category, 2 => Product, 3 => Pages, 4 => Contests');
			$table->integer('target_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_url_rewrite');
    }
}
