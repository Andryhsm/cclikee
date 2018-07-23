<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEncasementAddStoreId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encasement', function(Blueprint $table){
            $table->integer('store_id')->index('idx_store_id')->unsigned()->after('encasement_id');
            $table->foreign('store_id')
                ->references('store_id')->on('store');
            $table->dropForeign(['user_id']);

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
