<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->bigInteger('hotel')->unsigned()->index();
            $table->string('status', 20);
            $table->rememberToken();
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
        Schema::drop('m_vendor');
    }
}
