<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFeeShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fee_ships', function (Blueprint $table) {
            $table->increments('fee_id');
            $table->integer('fee_maxp');
            $table->integer('fee_matp');
            $table->integer('fee_maqh');
            $table->integer('fee_feesship');
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
        Schema::dropIfExists('tbl_fee_ships');
    }
}
