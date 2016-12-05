<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo');
            $table->bigInteger('hotel')->unsigned()->index();
            $table->integer('order')->nullable();
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
        Schema::drop('m_photo');
    }
}
