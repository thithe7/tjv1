<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopSellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_sell', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->nullable();
            $table->bigInteger('room')->unsigned()->index();
            $table->date('stop_date_from')->nullable();
            $table->date('stop_date_to')->nullable();
            $table->timestamps();
            $table->foreign('room')->references('id')->on('m_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stop_sell');
    }
}
