<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_adjustment', function (Blueprint $table) {
            $table->increments('link_adjustment_id');
            $table->integer('user_id')->index('idx_user_id')->unsigned();
			$table->string('link');
			$table->text('description')->nullable();
			$table->integer('created_by')->index('idx_created_by')->nullable()->unsigned();
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
        Schema::dropIfExists('link_adjustment');
    }
}
