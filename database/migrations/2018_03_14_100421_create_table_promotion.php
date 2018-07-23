<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion', function(Blueprint $table){
            $table->increments('promotion_id');
            $table->string('campagne_name');
            $table->integer('user_id')->index('idx_user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
            $table->integer('code_promo_id')->index('idx_code_promo_id')->unsigned()->nullable();
            $table->foreign('code_promo_id')
                ->references('code_promo_id')->on('code_promo')
                ->onDelete('set null');
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->integer('send_number');
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
        Schema::dropIfExists('promotion');
    }
}
