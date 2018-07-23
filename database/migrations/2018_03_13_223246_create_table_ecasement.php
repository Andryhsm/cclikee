<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEcasement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encasement', function (Blueprint $table) {
            $table->increments('encasement_id');
            $table->integer('user_id')->index('idx_user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('user_id')->on('users')->onDelete('set null');
            $table->integer('total_ht');
            $table->integer('total_ttc');
            $table->integer('discount');
            $table->integer('tva');
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
        Schema::dropIfExists('encasement');
    }
}
