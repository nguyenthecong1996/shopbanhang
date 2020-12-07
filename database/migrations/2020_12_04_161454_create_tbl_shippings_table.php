<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_shippings', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->string('shipping_name');
            $table->text('shipping_email');
            $table->text('shipping_address');
            $table->text('shipping_phone');
            $table->string('shipping_content');
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
        Schema::dropIfExists('tbl_shippings');
    }
}
