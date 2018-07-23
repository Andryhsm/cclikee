<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodePromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_promo', function (Blueprint $table) {
            $table->increments('code_promo_id');
            $table->integer('user_id')->index('idx_user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
            $table->string('code_promo_name');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('quantity_max');
            $table->timestamps();
        });

        Schema::create('code_promo_category', function (Blueprint $table){
            $table->integer('code_promo_id')->index('idx_code_promo_id')->unsigned()->nullable();
            $table->foreign('code_promo_id')
                ->references('code_promo_id')->on('code_promo')
                ->onDelete('cascade');
            $table->integer('category_id')->index('idx_category_id')->unsigned()->nullable();
            $table->foreign('category_id')
                ->references('category_id')->on('category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
