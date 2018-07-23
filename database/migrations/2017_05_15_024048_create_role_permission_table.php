<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role_permission', function (Blueprint $table) {
            $table->integer('permission_id')->index('idx_permission_id_id')->unsigned();
            $table->foreign('permission_id')
                ->references('permission_id')->on('permission')
                ->onDelete('cascade');
            $table->integer('role_id')->index('idx_role_id_id')->unsigned();
            $table->foreign('role_id')
                ->references('admin_role_id')->on('admin_role')
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
        Schema::dropIfExists('role_permission');
    }
}
