<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_set', function (Blueprint $table) {
            $table->increments('attribute_set_id');
			$table->string('set_name');
			$table->integer('created_by')->unsigned()->index('idx_created_by')->nullable();
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
        Schema::dropIfExists('attribute_set');
    }
}
