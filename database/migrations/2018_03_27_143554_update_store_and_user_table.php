<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoreAndUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable();
            $table->string('position')->nullable();
            $table->string('social_media_id')->nullable();
            $table->string('register_by')->nullable();
            $table->integer('radius')->nullable();
        });
        Schema::table('store', function (Blueprint $table) {
            $table->integer('registration_number');
            $table->string('shop_image')->nullable();
            $table->text('short_description')->nullable();
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('zip');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->dropColumn('created_date');
            $table->dropColumn('tva_number');
            $table->dropColumn('siret_number');
            $table->dropColumn('banque_number');
            $table->dropColumn('eban');
            $table->dropColumn('bic');            
            $table->dropColumn('banque_domicile');
            $table->dropColumn('banque_address');
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
