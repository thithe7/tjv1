<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMContractHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_contract_hotel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel')->unsigned()->index();
            $table->integer('cut_of_date');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->timestamps();
            $table->foreign('hotel')->references('id')->on('m_hotel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_contract_hotel');
    }
}
