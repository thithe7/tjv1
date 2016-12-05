<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_booking')->unsigned()->index();
            $table->string('p_name', 200);
            $table->string('p_title', 10)->nullable();
            $table->double('price');
            $table->timestamps();
            $table->foreign('id_booking')->references('id')->on('m_booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('d_booking');
    }
}
