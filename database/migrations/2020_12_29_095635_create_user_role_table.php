<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tbl_admin_id')->unsigned()->index();
            $table->foreign('tbl_admin_id')->references('id')->on('tbl_admin')->onDelete('cascade');

            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_admin_role');
    }
}
